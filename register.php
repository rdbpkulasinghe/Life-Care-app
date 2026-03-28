<?php
session_start();
include 'db.php';

// Debugging errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = trim($_POST['fullname']);
    $age = intval($_POST['age']);
    $contact = trim($_POST['contact']);
    $medical_history = trim($_POST['medical_history']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    if (!$check) {
        die("Prepare failed: " . $conn->error);
    }
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='register.html';</script>";
        exit();
    }
    $check->close();

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (fullname, age, contact, medical_history, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sisssss", $fullname, $age, $contact, $medical_history, $email, $password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! Please login.'); window.location.href='login.html';</script>";
    } else {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>