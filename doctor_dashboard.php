<?php
session_start();
include 'db.php';

// Only doctors can access
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'doctor'){
    header("Location: login.html");
    exit();
}

$doctor_id = $_SESSION['user_id'];
$today = date('Y-m-d');

// Fetch today's appointments
$todayAppointments = $conn->query("
    SELECT a.id, a.appointment_date, a.appointment_time,
           u.fullname AS patient_name, u.email AS patient_email, u.contact AS patient_contact
    FROM appointments a
    JOIN users u ON a.patient_id = u.id
    WHERE a.doctor_id = $doctor_id AND a.appointment_date = '$today'
    ORDER BY a.appointment_time ASC
");

// Fetch all upcoming appointments
$allAppointments = $conn->query("
    SELECT a.id, a.appointment_date, a.appointment_time,
           u.fullname AS patient_name, u.email AS patient_email, u.contact AS patient_contact
    FROM appointments a
    JOIN users u ON a.patient_id = u.id
    WHERE a.doctor_id = $doctor_id
    ORDER BY a.appointment_date ASC, a.appointment_time ASC
");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Doctor Dashboard - LifeCare Clinic</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Welcome, Dr. <?php echo $_SESSION['user_name']; ?></h2>
    <hr>

    <h4>Today's Appointments (<?php echo date('d-m-Y'); ?>)</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if($todayAppointments->num_rows > 0): ?>
                <?php while($row = $todayAppointments->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['patient_name']; ?></td>
                    <td><?= $row['patient_contact']; ?></td>
                    <td><?= $row['patient_email']; ?></td>
                    <td><?= $row['appointment_time']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No appointments today</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h4 class="mt-5">All Appointments</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if($allAppointments->num_rows > 0): ?>
                <?php while($row = $allAppointments->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['patient_name']; ?></td>
                    <td><?= $row['patient_contact']; ?></td>
                    <td><?= $row['patient_email']; ?></td>
                    <td><?= $row['appointment_date']; ?></td>
                    <td><?= $row['appointment_time']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No appointments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
</div>

</body>
</html>