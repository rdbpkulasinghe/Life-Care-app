<?php
session_start();
include 'db.php';

// Only logged-in patients
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user'){
    die("You must be logged in as a patient to book an appointment.");
}

// Fetch doctors
$doctors = $conn->query("SELECT id, fullname, medical_history FROM users WHERE role='doctor'");
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Appointment - LifeCare Clinic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-sm">
    <a class="navbar-brand" href="#">LifeCare</a>
  </div>
</nav>

<!-- Main -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Book an Appointment</h2>

  <div class="row justify-content-center">
    <div class="col-md-6">

      <form action="save_appointment.php" method="POST">

        <!-- Doctor -->
        <div class="mb-3">
          <label class="form-label">Select Doctor</label>
          <select name="doctor_id" class="form-select" required>
            <option value="">Choose a doctor</option>
            <?php while($doc = $doctors->fetch_assoc()): ?>
              <option value="<?= $doc['id'] ?>">
                <?= $doc['fullname']; ?> - <?= $doc['medical_history']; ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Date -->
        <div class="mb-3">
          <label class="form-label">Select Date</label>
          <input type="date" name="appointment_date" class="form-control" required>
        </div>

        <!-- Time -->
        <div class="mb-3">
          <label class="form-label">Select Time</label>
          <input type="time" name="appointment_time" class="form-control" required>
        </div>

        <div class="text-center">
          <button type="submit" class="btn btn-primary w-50">Book Appointment</button>
        </div>

      </form>

    </div>
  </div>
</div>

</body>
</html>