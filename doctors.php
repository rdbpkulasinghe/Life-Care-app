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
<title>Our Doctors - LifeCare Clinic</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f4f6f9;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.content {
  flex: 1;
}
.card-doctor {
  border-radius: 15px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  padding: 20px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.card-doctor:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}
.card-doctor img {
  border-radius: 50%;
  object-fit: cover;
  width: 120px;
  height: 120px;
  margin-bottom: 15px;
  border: 3px solid #0d6efd;
}
.doctor-name {
  font-weight: 600;
  font-size: 1.2rem;
}
.doctor-specialization {
  font-size: 0.9rem;
  color: #0d6efd;
  font-weight: 500;
}
footer {
  background-color: #212529;
  color: white;
  text-align: center;
  padding: 1rem;
}
</style>
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Main Content -->
<div class="container mt-5 content">
  <h2 class="text-center mb-4">Meet Our Doctors</h2>
  <div class="row g-4">
    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-doctor text-center">
                <?php if(!empty($row['photo']) && file_exists($row['photo'])): ?>
                  <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Doctor Photo">
                <?php else: ?>
                  <img src="default_avatar.png" alt="No Photo">
                <?php endif; ?>
                <div class="card-body">
                  <h5 class="doctor-name"><?= htmlspecialchars($row['fullname']) ?></h5>
                  <p class="doctor-specialization"><?= htmlspecialchars($row['medical_history']) ?></p>
                  <p>Contact: <?= htmlspecialchars($row['contact']) ?></p>
                  <p>Email: <?= htmlspecialchars($row['email']) ?></p>
                </div>
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
<footer>
  © 2024 LifeCare Clinic
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>