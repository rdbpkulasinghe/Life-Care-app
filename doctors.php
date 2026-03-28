<?php
session_start();
include 'db.php';

// Fetch all doctors
$sql = "SELECT * FROM users WHERE role='doctor' ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Doctors - LifeCare Clinic</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  .content {
    flex: 1;
  }
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-sm">
    <a class="navbar-brand" href="#">LifeCare</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
        <li class="nav-item"><a class="nav-link active" aria-current="page" href="doctors.php">Doctors</a></li>
        <li class="nav-item"><a class="nav-link" href="appointment.html">Appointment</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 content">
  <h2>Our Doctors</h2>
  <div class="row mt-4">
    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
              <div class="card p-3 mb-3 shadow-sm text-center">
                <?php if(!empty($row['photo']) && file_exists($row['photo'])): ?>
                  <img src="<?= $row['photo'] ?>" alt="Doctor Photo" class="rounded-circle mb-2" width="120" height="120">
                <?php else: ?>
                  <img src="default_avatar.png" alt="No Photo" class="rounded-circle mb-2" width="120" height="120">
                <?php endif; ?>
                <h5><?= htmlspecialchars($row['fullname']) ?></h5>
                <p><?= htmlspecialchars($row['medical_history']) ?></p>
              </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="col-12 text-center">
          <p>No doctors found.</p>
        </div>
    <?php endif; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3">
  © 2024 LifeCare Clinic
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>