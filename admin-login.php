<?php
session_start();

// Fixed admin credentials
$admin_username = "admin";
$admin_password = "admin123"; // Change if you like

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $admin_username && $password === $admin_password){
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location='../admin-login.html';</script>";
    }
} else {
    header("Location: ../admin-login.html");
    exit();
}
?>
