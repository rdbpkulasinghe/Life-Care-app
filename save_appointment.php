<?php
session_start();
include 'db.php';

// Check login
if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$patient_id = $_SESSION['user_id'];
$doctor_id = $_POST['doctor_id'];
$date = $_POST['appointment_date'];
$time = $_POST['appointment_time'];

// Insert into DB
$stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $patient_id, $doctor_id, $date, $time);

if($stmt->execute()){
    echo "<script>alert('Appointment booked successfully'); window.location.href='appointment.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}
?>