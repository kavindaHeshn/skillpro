<?php
include "../configuration/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName  = mysqli_real_escape_string($conn, $_POST['lastName']);
    $email     = mysqli_real_escape_string($conn, $_POST['email']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $role      = mysqli_real_escape_string($conn, $_POST['role']);
    $password  = $_POST['password'];
    $confirm   = $_POST['confirmPassword'];

    // Password check
    if ($password !== $confirm) {
        echo "Passwords do not match!";
        exit();
    }

    // Email already exists?
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "Email already registered!";
        exit();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users 
            (first_name, last_name, email, phone, role, password)
            VALUES 
            ('$firstName','$lastName','$email','$phone','$role','$hashedPassword')";

    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
