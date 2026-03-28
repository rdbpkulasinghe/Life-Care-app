<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Services - LifeCare Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css" />

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
    <?php include 'navbar.php'; ?>

    <!-- Main Content -->
    <div class="container mt-5 content">
      <h2>Our Services</h2>
      <ul class="list-group mt-3">
        <li class="list-group-item">General Checkups</li>
        <li class="list-group-item">Specialist Consultations</li>
        <li class="list-group-item">Laboratory Services</li>
        <li class="list-group-item">Wellness Programs</li>
        <li class="list-group-item">Vaccinations</li>
        <li class="list-group-item">Health Counseling</li>
      </ul>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
      © 2024 LifeCare Clinic
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
