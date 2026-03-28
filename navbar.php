<?php
// Optional: start session if you need to check login
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-sm">
    <a class="navbar-brand" href="#">LifeCare</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
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
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

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