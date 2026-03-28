<?php
session_start();
include 'db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.html");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fullname = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $specialization = trim($_POST['specialization']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'doctor';

    // Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if($check->num_rows > 0){
        echo "<script>alert('Email already registered!'); window.location.href='add_doctor.html';</script>";
        exit();
    }
    $check->close();

    // Handle photo upload
    $photo_path = NULL;
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0){
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif'];
        if(in_array(strtolower($ext), $allowed)){
            $new_name = uniqid('doc_').'.'.$ext;
            $upload_dir = 'uploads/doctors/';
            if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
            $photo_path = $upload_dir.$new_name;
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);
        } else {
            echo "<script>alert('Invalid image format!'); window.location.href='add_doctor.html';</script>";
            exit();
        }
    }

    // Insert doctor into database
    $stmt = $conn->prepare("INSERT INTO users (fullname, contact, email, medical_history, password, role, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullname, $contact, $email, $specialization, $password, $role, $photo_path);

    if($stmt->execute()){
        echo "<script>alert('Doctor added successfully!'); window.location.href='admin_doctors.php';</script>";
    } else {
        die("Error: ".$stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>