<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    die("Login required");
}

$id = intval($_GET['id']);
$patient_id = $_SESSION['user_id'];

// Only delete own appointment
$conn->query("DELETE FROM appointments WHERE id=$id AND patient_id=$patient_id");

header("Location: my_appointments.php");
exit();
?>