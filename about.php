<?php
session_start();
include 'db.php';

// Fetch all doctors
$sql = "SELECT * FROM users WHERE role='doctor' ORDER BY id ASC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>About Us - LifeCare Clinic</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/style.css" />
<style>
body { display: flex; flex-direction: column; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f4f6f9; }
.content { flex: 1; }
.hero { background: #0d6efd; color: white; padding: 60px 0; text-align: center; }
.card h5 { font-weight: 600; }
.card-doctor { border-radius: 15px; padding: 20px; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
.card-doctor:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.15); }
.card-doctor img { border-radius: 50%; width: 120px; height: 120px; object-fit: cover; margin-bottom: 15px; border: 3px solid #0d6efd; }
.doctor-name { font-weight: 600; font-size: 1.2rem; }
.doctor-specialization { font-size: 0.95rem; color: #0d6efd; font-weight: 500; }
footer { background-color: #212529; color: white; text-align: center; padding: 1rem; }
</style>
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<!-- Hero Section -->
<div class="hero">
  <div class="container">
    <h1>About LifeCare Clinic</h1>
    <p>Your health is our top priority. Compassionate care for your entire family.</p>
  </div>
</div>

<!-- Main Content -->
<div class="container mt-5 content">
  <!-- Clinic Overview -->
  <h2>Who We Are</h2>
  <p>LifeCare Wellness Clinic provides modern healthcare services with experienced doctors and advanced facilities. We ensure quality medical care and wellness programs for all patients in a professional and compassionate environment.</p>
  <p>We focus on personalized treatment plans, patient safety, and maintaining a hygienic environment for every patient.</p>

  <!-- Mission & Vision -->
  <div class="row mt-5">
    <div class="col-md-6 mb-4">
      <div class="card p-4 shadow-sm h-100">
        <h5>Our Mission</h5>
        <p>To provide accessible, high-quality healthcare with a focus on prevention, early detection, and patient-centered care.</p>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card p-4 shadow-sm h-100">
        <h5>Our Vision</h5>
        <p>To be the leading wellness clinic in the region, recognized for excellence in healthcare and patient satisfaction.</p>
      </div>
    </div>
  </div>

  <!-- Core Values -->
  <div class="mt-5 text-center">
    <h2>Our Core Values</h2>
    <div class="row mt-4">
      <div class="col-md-4 mb-4">
        <div class="card p-4 shadow-sm h-100">
          <h5>Compassion</h5>
          <p>We treat every patient with empathy and respect.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card p-4 shadow-sm h-100">
          <h5>Excellence</h5>
          <p>High-quality care with skilled professionals and modern facilities.</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card p-4 shadow-sm h-100">
          <h5>Integrity</h5>
          <p>Honesty, transparency, and professionalism in everything we do.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Team Section -->
  <div class="mt-5 text-center">
    <h2>Meet Our Team</h2>
    <div class="row mt-4 g-4">
      <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card card-doctor text-center">
              <?php if(!empty($row['photo']) && file_exists($row['photo'])): ?>
                <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Dr <?= htmlspecialchars($row['fullname']) ?>">
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
        <div class="col-12">
          <p class="text-center">No doctors found.</p>
        </div>
      <?php endif; ?>
    </div>
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