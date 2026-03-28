<?php
session_start();
include 'db.php';

// Only admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

// Delete appointment
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM appointments WHERE id=$id");
    header("Location: admin_appointments.php");
    exit();
}

// Fetch appointments with JOIN
$sql = "SELECT a.id,
               p.fullname AS patient_name,
               p.email AS patient_email,
               d.fullname AS doctor_name,
               a.appointment_date,
               a.appointment_time,
               a.created_at
        FROM appointments a
        JOIN users p ON a.patient_id = p.id
        JOIN users d ON a.doctor_id = d.id
        ORDER BY a.appointment_date, a.appointment_time";

$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Appointments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Appointments</h2>

    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Time</th>
                <th>Booked At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['patient_name']; ?></td>
                    <td><?= $row['patient_email']; ?></td>
                    <td><?= $row['doctor_name']; ?></td>
                    <td><?= $row['appointment_date']; ?></td>
                    <td><?= $row['appointment_time']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <a href="admin_appointments.php?delete_id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this appointment?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-danger">No appointments found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>