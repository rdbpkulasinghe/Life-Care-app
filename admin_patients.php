<?php
session_start();
include 'db.php';

// Only admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

// Delete patient
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);

    // Optional: delete related appointments first
    $conn->query("DELETE FROM appointments WHERE patient_id=$id");

    // Delete patient
    $conn->query("DELETE FROM users WHERE id=$id AND role='user'");

    header("Location: admin_patients.php");
    exit();
}

// Fetch patients
$patients = $conn->query("SELECT * FROM users WHERE role='user'");
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Patients</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Patient List</h2>

    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">Back to Dashboard</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Medical Info</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if($patients->num_rows > 0): ?>
                <?php while($row = $patients->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['fullname']; ?></td>
                    <td><?= $row['age']; ?></td>
                    <td><?= $row['contact']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['medical_history']; ?></td>
                    <td>
                        <a href="admin_patients.php?delete_id=<?= $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this patient?');">
                           Delete
                        </a>
                        <a href="edit_patient.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-danger">
                        No patients found
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>