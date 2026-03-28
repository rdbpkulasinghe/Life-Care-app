<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - LifeCare Clinic</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?> (Admin)</h2>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <a href="admin_patients.php" class="btn btn-primary w-100 mb-2">Manage Patients</a>
        </div>
        <div class="col-md-4">
            <a href="admin_doctors.php" class="btn btn-success w-100 mb-2">Manage Doctors</a>
        </div>
        <div class="col-md-4">
            <a href="admin_appointments.php" class="btn btn-warning w-100 mb-2">Manage Appointments</a>
        </div>
    </div>
    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>
</body>
</html>