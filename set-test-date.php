<?php
include 'db.php';

// Only allow admin
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../admin-login.html");
    exit();
}

// Handle form submission
if(isset($_POST['exam_name'], $_POST['exam_date'])){
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $exam_date = mysqli_real_escape_string($conn, $_POST['exam_date']);

    $query = "INSERT INTO test_dates (exam_name, exam_date) VALUES ('$exam_name', '$exam_date')";
    if(mysqli_query($conn, $query)){
        echo "<div class='alert success'>Test date added successfully!</div>";
    } else {
        echo "<div class='alert error'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<h2>Set Test Dates</h2>

<form method="POST">
    <input type="text" name="exam_name" placeholder="Exam Name" required>
    <input type="date" name="exam_date" required>
    <button type="submit">Set Date</button>
</form>

<style>
form input, form button { display:block; margin:8px 0; padding:10px; width:100%; border-radius:5px; border:1px solid #ccc; }
form button { background:#007bff; color:white; border:none; cursor:pointer; }
form button:hover { background:#0056b3; }
.alert { padding:10px; margin:10px 0; border-radius:5px; }
.success { background:#d4edda; color:#155724; }
.error { background:#f8d7da; color:#721c24; }
</style>
