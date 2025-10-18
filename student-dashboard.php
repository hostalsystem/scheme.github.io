<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: student-login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Dashboard</title>
</head>
<body>
  <h2>Welcome, <?php echo $_SESSION['student_name']; ?>!</h2>
  <p>Your login was successful.</p>
</body>
</html>
<?php if(!empty($student['roll_number'])): ?>
    <a href="rollnumber.php" target="_blank">
        <button>View/Download Roll Number Slip</button>
    </a>
<?php else: ?>
    <p>Roll Number not assigned yet. Please wait for admin approval.</p>
<?php endif; ?>
