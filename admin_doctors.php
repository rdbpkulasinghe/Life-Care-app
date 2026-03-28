<?php
session_start();
include 'db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

// Delete doctor
if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM users WHERE id=$id AND role='doctor'");
    header("Location: admin_doctors.php");
    exit();
}

// Fetch doctors
$doctors = $conn->query("SELECT * FROM users WHERE role='doctor'");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Doctors</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Doctor List</h2>

  <a href="admin_dashboard.php" class="btn btn-secondary mb-2">Back to Dashboard</a>
  <a href="add_doctor.html" class="btn btn-success mb-2">Add Doctor</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Specialization</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php if($doctors && $doctors->num_rows > 0): ?>
        <?php while($row = $doctors->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= $row['fullname']; ?></td>
          <td><?= $row['contact']; ?></td>
          <td><?= $row['email']; ?></td>
          <td><?= $row['medical_history']; ?></td>
          <td>
            <a href="edit_doctor.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="admin_doctors.php?delete_id=<?= $row['id']; ?>" 
               class="btn btn-danger btn-sm"
               onclick="return confirm('Delete this doctor?');">
               Delete
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" class="text-center text-danger">No doctors found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>