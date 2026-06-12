<?php
session_start();

// Login check
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['staff', 'instructor', 'admin'])) {
    header('Location: login.php');
    exit();
}

$is_admin = $_SESSION['role'] === 'admin';
$is_staff_or_above = in_array($_SESSION['role'], ['staff', 'admin']);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "skillpro";

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        die('<div class="error">Connection failed: ' . $conn->connect_error . '</div>');
    }
    $conn->set_charset("utf8mb4");

    // Handle Edit User - UPDATED WITH NEW PERMISSIONS
    if (isset($_POST['edit_user']) && $is_staff_or_above) {
        $id         = (int)$_POST['id'];
        $first_name = trim($_POST['first_name']);
        $last_name  = trim($_POST['last_name']);
        $email      = trim($_POST['email']);
        $phone      = trim($_POST['phone']);
        $role       = $is_admin ? $_POST['role'] : $_SESSION['role']; // non-admin can't escalate

        // Fetch current user role
        $check = $conn->prepare("SELECT role FROM users WHERE id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $result_check = $check->get_result();
        if ($result_check->num_rows === 0) {
            echo '<div class="error">User not found.</div>';
        } else {
            $current_role = $result_check->fetch_assoc()['role'];
            $check->close();

            // Permission logic
            $allowed = false;
            if ($is_admin) {
                $allowed = true; // Admin can edit anyone
            } elseif ($_SESSION['role'] === 'staff') {
                // Staff can edit students, instructors, and other staff (NOT admins)
                $allowed = in_array($current_role, ['student', 'instructor', 'staff']);
            }

            if ($allowed) {
                // Non-admin users cannot change role at all (prevents escalation)
                if (!$is_admin) {
                    $role = $current_role;
                }

                $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, phone=?, role=? WHERE id=?");
                $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $role, $id);
                if ($stmt->execute()) {
                    echo '<div class="success-msg">User updated successfully!</div>';
                } else {
                    echo '<div class="error">Update failed: '.$stmt->error.'</div>';
                }
                $stmt->close();
            } else {
                echo '<div class="error">You are not authorized to edit this user.</div>';
            }
        }
    }

    // Fetch users & counts
    $sql = "SELECT id, first_name, last_name, email, phone, role, created_at FROM users ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $count_students = $conn->query("SELECT COUNT(*) AS c FROM users WHERE role='student'")->fetch_assoc()['c'];
    $count_instructors = $conn->query("SELECT COUNT(*) AS c FROM users WHERE role='instructor'")->fetch_assoc()['c'];
    $count_staff = $conn->query("SELECT COUNT(*) AS c FROM users WHERE role='staff' OR role='admin'")->fetch_assoc()['c'];

} catch (Exception $e) {
    echo '<div class="error">Database error: '.$e->getMessage().'</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillPro - Manage Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #059669;      /* Emerald Green */
            --primary-dark: #047857;
            --accent: #f59e0b;        /* Amber */
            --accent-hover: #d97706;
            --bg: #f0fdf4;            /* Very light green */
            --card: #ffffff;
            --text: #1f2937;
            --text-light: #6b7280;
            --border: #d1d5db;
            --success: #10b981;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .flex-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #064e3b, #065f46);
            color: white;
            padding: 2rem 1rem;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            position: relative;
        }

        .logo img {
            width: 100px;
            display: block;
            margin: 0 auto 1rem;
            border-radius: 50%;
            border: 4px solid var(--accent);
        }

        .sidebar h1 {
            text-align: center;
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .nav-link {
            display: block;
            padding: 1rem;
            color: #e6f4ea;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--accent);
            color: #1f2937;
            transform: translateX(8px);
        }

        .btn-logout {
            width: 100%;
            padding: 1rem;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 2rem;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #dc2626;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: auto;
        }

        .header h2 {
            font-size: 1.8rem;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        .container {
            background: var(--card);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #d4f4dd;
        }

        .container h1 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            font-size: 2.2rem;
        }

        /* Summary Cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .summary-card {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(5,150,105,0.3);
        }

        .summary-card h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            opacity: 0.9;
        }

        .summary-card .count {
            font-size: 2.5rem;
            font-weight: 700;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        th {
            background: var(--primary);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid var(--border);
        }

        tr:hover {
            background: #f0fdf4;
        }

        .action-btn {
            padding: 0.6rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            margin: 0 0.3rem;
            transition: all 0.3s;
        }

        .edit-btn {
            background: var(--accent);
            color: #1f2937;
        }

        .edit-btn:hover {
            background: var(--accent-hover);
            transform: scale(1.05);
        }

        .delete-btn {
            background: var(--danger);
            color: white;
        }

        .delete-btn:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        /* Messages */
        .success-msg {
            background: #d4f4dd;
            color: var(--success);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
            font-weight: 600;
            border: 1px solid var(--success);
        }

        .error {
            background: #fee2e2;
            color: var(--danger);
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid var(--danger);
            margin: 1rem 0;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            width: 90%;
            max-width: 550px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            border: 3px solid var(--accent);
        }

        .modal-content h2 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
        }

        .modal-content label {
            display: block;
            margin: 1rem 0 0.5rem;
            font-weight: 500;
            color: var(--text);
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .modal-content input:focus,
        .modal-content select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(5,150,105,0.2);
        }

        .modal-content button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1.5rem;
            margin-right: 1rem;
            transition: 0.3s;
        }

        .save-btn {
            background: var(--primary);
            color: white;
        }

        .save-btn:hover {
            background: var(--primary-dark);
        }

        .cancel-btn {
            background: #6b7280;
            color: white;
        }

        .cancel-btn:hover {
            background: #4b5563;
        }

        @media (max-width: 768px) {
            .flex-container { flex-direction: column; }
            .sidebar { width: 100%; padding: 1rem; }
            .summary-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="flex-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo"><img src="../photo/logo.jpeg" alt="SkillPro Logo"></div>
        <h1>SkillPro</h1>
        <nav>
            <a href="applications.php" class="nav-link">Course Applications</a>
            <a href="timetable.php" class="nav-link">Timetable</a>
            <a href="users.php" class="nav-link active">Manage Users</a>
            <a href="feedback.php" class="nav-link">Feedback</a>
            <button id="logoutBtn" class="btn-logout">Logout</button>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Admin Dashboard - <?php echo ucfirst(htmlspecialchars($_SESSION['role'] ?? '')); ?></h2>
        </div>

        <div class="container">
            <h1>Manage Users</h1>

            <!-- Success/Error Messages -->
            <?php if (isset($_POST['edit_user'])): ?>
                <!-- Messages already echoed in PHP section -->
            <?php endif; ?>

            <!-- Summary Cards -->
            <div class="summary-grid">
                <div class="summary-card">
                    <h3>Students</h3>
                    <div class="count"><?php echo $count_students; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Instructors</h3>
                    <div class="count"><?php echo $count_instructors; ?></div>
                </div>
                <div class="summary-card">
                    <h3>Staff & Admin</h3>
                    <div class="count"><?php echo $count_staff; ?></div>
                </div>
            </div>

            <!-- Users Table -->
            <?php if ($result && $result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()):
                            $full_name = trim($row['first_name'] . ' ' . $row['last_name']);

                            // Edit permission
                            if ($is_admin) {
                                $can_edit = true;
                            } elseif ($_SESSION['role'] === 'staff') {
                                $can_edit = in_array($row['role'], ['student', 'instructor', 'staff']);
                            } else {
                                $can_edit = false;
                            }

                            // Delete permission - only admin
                            $can_delete = $is_admin;
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($full_name); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td><strong><?php echo ucfirst(htmlspecialchars($row['role'])); ?></strong></td>
                                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                <td>
                                    <?php if ($can_edit): ?>
                                        <button class="action-btn edit-btn" onclick='openEditModal(<?php echo json_encode($row); ?>)'>
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($can_delete): ?>
                                        <button class="action-btn delete-btn" onclick="deleteUser(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars(addslashes($full_name)); ?>')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center; padding:2rem; color:var(--text-light);">No users found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Edit User</h2>
        <form method="POST">
            <input type="hidden" name="id" id="editId">
            
            <label>First Name</label>
            <input type="text" name="first_name" id="editFirstName" required>
            
            <label>Last Name</label>
            <input type="text" name="last_name" id="editLastName" required>
            
            <label>Email</label>
            <input type="email" name="email" id="editEmail" required>
            
            <label>Phone</label>
            <input type="text" name="phone" id="editPhone" required>
            
            <label>Role</label>
            <select name="role" id="editRole" <?php echo !$is_admin ? 'disabled' : ''; ?>>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
                <option value="staff">Staff</option>
                <?php if ($is_admin): ?>
                    <option value="admin">Admin</option>
                <?php endif; ?>
            </select>
            
            <div style="text-align:center;">
                <button type="submit" name="edit_user" class="save-btn">Save Changes</button>
                <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        document.getElementById('editId').value = user.id;
        document.getElementById('editFirstName').value = user.first_name;
        document.getElementById('editLastName').value = user.last_name;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPhone').value = user.phone;
        document.getElementById('editRole').value = user.role;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    document.getElementById('logoutBtn').addEventListener('click', () => {
        if (confirm('Are you sure you want to logout?')) {
            location.href = 'logout.php';
        }
    });

    function deleteUser(id, name) {
        if (confirm(`Permanently delete user "${name}"? This cannot be undone.`)) {
            fetch('delete_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + id
            })
            .then(r => r.json())
            .then(data => {
                alert(data.message);
                if (data.success) location.reload();
            })
            .catch(() => alert('Error deleting user.'));
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target == modal) {
            closeEditModal();
        }
    }
</script>
</body>
</html>
<?php if (isset($conn)) $conn->close(); ?>