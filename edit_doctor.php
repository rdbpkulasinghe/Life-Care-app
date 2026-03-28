<?php
session_start();
include 'db.php';

// Only admin access
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

// Get doctor ID
if(!isset($_GET['id'])){
    die("Doctor ID not provided.");
}

$id = intval($_GET['id']);

// Fetch doctor data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=? AND role='doctor'");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Doctor not found.");
}

$doctor = $result->fetch_assoc();
$stmt->close();

// Update doctor
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $specialization = trim($_POST['specialization']);

    $update = $conn->prepare("UPDATE users SET fullname=?, contact=?, email=?, medical_history=? WHERE id=? AND role='doctor'");
    $update->bind_param("ssssi", $fullname, $contact, $email, $specialization, $id);

    if($update->execute()){
        echo "<script>alert('Doctor updated successfully!'); window.location.href='admin_doctors.php';</script>";
        exit();
    } else {
        echo "Error: " . $update->error;
    }

    $update->close();
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Doctor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Doctor</h2>

    <a href="admin_doctors.php" class="btn btn-secondary mb-3">Back</a>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullname" class="form-control"
                   value="<?php echo $doctor['fullname']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact" class="form-control"
                   value="<?php echo $doctor['contact']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?php echo $doctor['email']; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Specialization</label>
            <input type="text" name="specialization" class="form-control"
                   value="<?php echo $doctor['medical_history']; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Doctor</button>

    </form>
</div>

</body>
</html>