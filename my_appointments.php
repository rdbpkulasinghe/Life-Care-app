<?php
session_start();
include 'db.php';

// Only logged-in patients
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user'){
    header("Location: login.html");
    exit();
}

$patient_id = $_SESSION['user_id'];

// Fetch patient's appointments
$sql = "SELECT a.id,
               d.fullname AS doctor_name,
               d.medical_history AS specialization,
               a.appointment_date,
               a.appointment_time,
               a.created_at
        FROM appointments a
        JOIN users d ON a.doctor_id = d.id
        WHERE a.patient_id = ?
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Appointments</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php include 'navbar.php'; ?>
<body>

<div class="container mt-5">
    <h2>My Appointments</h2>

    <a href="appointment.php" class="btn btn-primary mb-3">Book New Appointment</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor</th>
                <th>Specialization</th>
                <th>Date</th>
                <th>Time</th>
                <th>Booked At</th>
            </tr>
        </thead>

        <tbody>
            <?php if($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['doctor_name']; ?></td>
                    <td><?= $row['specialization']; ?></td>
                    <td><?= $row['appointment_date']; ?></td>
                    <td><?= $row['appointment_time']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td><a href="cancel_appointment.php?id=<?= $row['id']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Cancel this appointment?');">
   Cancel
</a></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-danger">
                        No appointments found
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>