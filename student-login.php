<?php
session_start();
include('db.php'); // both PHP files are in backend, so this path is fine

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $fname = trim($_POST['fname']);

    // Query to check the student
    $query = "SELECT * FROM students WHERE full_name = ? AND father_name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $name, $fname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        $student = mysqli_fetch_assoc($result);

        // Store student data in session
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['full_name'];

        // Redirect to dashboard in the same folder
        header("Location: student-dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials! Please check your details.'); window.location='../student-login.html';</script>";
        exit();
    }
} else {
    header("Location: ../student-login.html");
    exit();
}
?>
