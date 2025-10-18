<?php
session_start();
include 'db.php'; // same folder

// Check if admin is logged in
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: admin-login.html");
    exit();
}

// Check if form is submitted
if(isset($_POST['student_id'], $_POST['subject'], $_POST['marks_obtained'], $_POST['total_marks'], $_POST['grade'])){

    $student_id = $_POST['student_id'];
    $subject = $_POST['subject'];
    $marks_obtained = (int)$_POST['marks_obtained'];
    $total_marks = (int)$_POST['total_marks'];
    $grade = $_POST['grade'];

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO results (student_id, subject, marks_obtained, total_marks, grade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdds", $student_id, $subject, $marks_obtained, $total_marks, $grade);

    if($stmt->execute()){
        $_SESSION['success_msg'] = "Result added successfully!";
    } else {
        $_SESSION['error_msg'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin-dashboard.php?tab=manage-results");
    exit();

} else {
    $_SESSION['error_msg'] = "All fields are required!";
    header("Location: admin-dashboard.php?tab=manage-results");
    exit();
}
?>
