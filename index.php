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
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-sm">
    <a class="navbar-brand" href="#">LifeCare</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
        <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
         <li class="nav-item">
          <a class="nav-link" href="my_appointments.php">
            My Appointments
          </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="doctors.php">Doctors</a></li>
        <li class="nav-item">
          <a class="nav-link" href="appointment.php">
            Appointment
          </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>

        <?php if(isset($_SESSION['user_name'])): ?>
          <li class="nav-item">
            <span class="nav-link text-light">Hi, <?php echo $_SESSION['user_name']; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.html">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero text-center mt-4">
  <h1>Welcome to LifeCare Wellness Clinic</h1>
  <p>We provide quality healthcare services for you and your family.</p>

  <?php if(isset($_SESSION['user_name'])): ?>
    <a href="appointment.html" class="btn btn-light btn-lg mt-3">Book Appointment</a>
  <?php else: ?>
    <a href="login.html" class="btn btn-light btn-lg mt-3">Login to Book Appointment</a>
  <?php endif; ?>
</div>

<!-- Services Section -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Our Services</h2>
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card p-4">
        <h5>General Checkup</h5>
        <p>Comprehensive health assessment for all ages.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card p-4">
        <h5>Pediatrics</h5>
        <p>Expert care for children and infants.</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card p-4">
        <h5>Cardiology</h5>
        <p>Advanced heart care services with modern equipment.</p>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3 mt-5">
  © 2024 LifeCare Clinic
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>