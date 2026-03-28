<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user'){
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LifeCare Clinic</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<section class="hero text-center d-flex flex-column justify-content-center align-items-center">
  <h1 class="display-4 fw-bold">Welcome to LifeCare Wellness Clinic</h1>
  <p class="lead mb-4">Quality healthcare services for you and your family.</p>
  <?php if(isset($_SESSION['user_name'])): ?>
    <a href="appointment.php" class="btn btn-light btn-lg px-4 py-2 shadow-sm">Book Appointment</a>
  <?php else: ?>
    <a href="login.html" class="btn btn-light btn-lg px-4 py-2 shadow-sm">Login to Book Appointment</a>
  <?php endif; ?>
</section>

<!-- Services Section -->
<section class="container mt-5 mb-5">
  <h2 class="text-center mb-5 fw-bold">Our Services</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-4 text-center h-100 service-card">
        <div class="icon mb-3">
          <img src="images/checkup.png" alt="Checkup" width="50">
        </div>
        <h5 class="fw-bold">General Checkup</h5>
        <p>Comprehensive health assessment for all ages.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center h-100 service-card">
        <div class="icon mb-3">
          <img src="images/pediatrics.png" alt="Pediatrics" width="50">
        </div>
        <h5 class="fw-bold">Pediatrics</h5>
        <p>Expert care for children and infants.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4 text-center h-100 service-card">
        <div class="icon mb-3">
          <img src="images/cardiology.png" alt="Cardiology" width="50">
        </div>
        <h5 class="fw-bold">Cardiology</h5>
        <p>Advanced heart care services with modern equipment.</p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-4 mt-auto">
  © 2024 LifeCare Clinic
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>