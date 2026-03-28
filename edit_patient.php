<?php
session_start();
include 'db.php';

// Only admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

// Get patient ID
if(!isset($_GET['id'])){
    die("Invalid request");
}

$id = intval($_GET['id']);

// Fetch patient data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=? AND role='user'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Patient not found");
}

$patient = $result->fetch_assoc();

// Update patient
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = trim($_POST['fullname']);
    $age = intval($_POST['age']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $medical = trim($_POST['medical_history']);

    $update = $conn->prepare("UPDATE users 
        SET fullname=?, age=?, contact=?, email=?, medical_history=? 
        WHERE id=? AND role='user'");
    $update->bind_param("sisssi", $fullname, $age, $contact, $email, $medical, $id);

    if($update->execute()){
        echo "<script>alert('Patient updated successfully'); window.location.href='admin_patients.php';</script>";
    } else {
        echo "Error: " . $update->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Patient</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Patient</h2>

    <a href="admin_patients.php" class="btn btn-secondary mb-3">Back</a>

    <form method="POST">

        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="fullname" class="form-control"
                   value="<?= $patient['fullname']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control"
                   value="<?= $patient['age']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control"
                   value="<?= $patient['contact']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= $patient['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Medical Info</label>
            <textarea name="medical_history" class="form-control" required><?= $patient['medical_history']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Patient</button>

    </form>
</div>

</body>
</html>