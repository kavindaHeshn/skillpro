<?php
session_start();
include '../configuration/config.php';

// Get form data
$email = trim($_POST['username']); // form eke "Username or Email" kiyala thibbata DB eke email witharai
$password = trim($_POST['password']);

// Empty check
if (empty($email) || empty($password)) {
    echo "❌ Please fill in both fields.";
    exit;
}

// Prepare SQL (email only)
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Role based redirect
        if ($user['role'] === 'staff') {
            header("Location: ../staff/users.php");
        } elseif ($user['role'] === 'instructor') {
            header("Location: ../admin/users.php");
        } else { // student
            header("Location: ../viwepanel/home.php");
        }
        exit;

    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ User not found.";
}

$stmt->close();
$conn->close();
?>
