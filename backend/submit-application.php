<?php
session_start();
include '../configuration/config.php';

// Get POST data
$course_id   = $_POST['course_id'];
$course_name = $_POST['course_name'];
$full_name   = trim($_POST['full_name']);
$email       = trim($_POST['email']);
$phone       = trim($_POST['phone']);
$nic         = trim($_POST['nic']);
$branch      = $_POST['branch'];
$message     = trim($_POST['message']);

// Basic validation
if (
    empty($course_id) || empty($course_name) ||
    empty($full_name) || empty($email) ||
    empty($phone) || empty($nic) || empty($branch)
) {
    echo "❌ Please fill in all required fields.";
    exit;
}

// Insert data
$sql = "INSERT INTO course_applications
        (course_id, course_name, full_name, email, phone, nic, branch, message)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "isssssss",
    $course_id,
    $course_name,
    $full_name,
    $email,
    $phone,
    $nic,
    $branch,
    $message
);

if ($stmt->execute()) {
    // Success redirect
    header("Location: application-success.php");
    exit;
} else {
    echo "❌ Application failed. Please try again.";
}

$stmt->close();
$conn->close();
?>
