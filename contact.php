<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact - LifeCare Clinic</title>
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
<?php include 'navbar.php'; ?>

<!-- Main Content -->
<div class="container mt-5 content">
  <h2>Contact Us</h2>
  <p><strong>Email:</strong> lifecare@gmail.com</p>
  <p><strong>Phone:</strong> +94 77 123 4567</p>
  <p><strong>Location:</strong> Colombo, Sri Lanka</p>
  <p><strong>Map:</strong> <a href="#" target="_blank">View Map</a></p>

  <!-- Optional: Contact Form -->
  <div class="mt-4">
    <h4>Send Us a Message</h4>
    <form>
      <div class="mb-3">
        <label for="contactName" class="form-label">Name</label>
        <input type="text" class="form-control" id="contactName" placeholder="Your Name" required>
      </div>
      <div class="mb-3">
        <label for="contactEmail" class="form-label">Email</label>
        <input type="email" class="form-control" id="contactEmail" placeholder="Your Email" required>
      </div>
      <div class="mb-3">
        <label for="contactMessage" class="form-label">Message</label>
        <textarea class="form-control" id="contactMessage" rows="4" placeholder="Your Message" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3 mt-5">
  © 2024 LifeCare Clinic
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>