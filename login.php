<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, fullname, password, role FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($user = $result->fetch_assoc()){
    if(password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['fullname'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if($user['role'] == 'admin'){
            header("Location: admin_dashboard.php");
        } elseif($user['role'] == 'doctor'){
            header("Location: doctor_dashboard.php");
        } else {
            header("Location: index.php"); // normal patient
        }
        exit();
    } else {
        echo "<script>alert('Wrong password!'); window.location.href='login.html';</script>";
    }
} else {
    echo "<script>alert('User not found!'); window.location.href='login.html';</script>";
}
?>