<?php
session_start();
include('db.php');

if (!isset($_SESSION['student_id'])) {
    header("Location: ../student-login.html");
    exit();
}

$student_id = $_SESSION['student_id'];
$query = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$student = mysqli_fetch_assoc($result);

// Example test date (you can store in DB if needed)
$test_date = "15 October 2025";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roll Number Slip</title>
  <link rel="stylesheet" href="rollnumber.css">
</head>
<body>
  <div class="slip-container">
    <div class="header">
      <img src="logo.png" alt="Logo" class="logo">
      <h2>Laptop Scheme Examination</h2>
      <p>Official Roll Number Slip</p>
    </div>

    <div class="student-info">
      <div class="info-left">
        <?php
        $photo = !empty($student['photo']) ? $student['photo'] : 'student-photo.jpg';
        echo "<img src='../uploads/$photo' alt='Student Photo' class='student-photo'>";
        ?>
      </div>

      <div class="info-right">
        <p><strong>Name:</strong> <?php echo $student['full_name']; ?></p>
        <p><strong>Father’s Name:</strong> <?php echo $student['father_name']; ?></p>
        <p><strong>School:</strong> <?php echo $student['school']; ?></p>
        <p><strong>Course:</strong> <?php echo $student['course']; ?></p>
        <p><strong>Contact:</strong> <?php echo $student['contact']; ?></p>
        <p><strong>Roll Number:</strong> <?php echo $student['roll_number'] ?? "Not Assigned Yet"; ?></p>
        <p><strong>Test Date:</strong> <?php echo $test_date; ?></p>
      </div>
    </div>

    <div class="instructions">
      <h3>Instructions for Candidates:</h3>
      <ul>
        <li>Bring this slip and your original CNIC or B-Form on test day.</li>
        <li>Mobile phones, calculators, and electronic gadgets are not allowed.</li>
        <li>Reach the exam center at least 30 minutes before the test time.</li>
      </ul>
    </div>

    <div class="footer">
      <p>For queries, contact: support@laptopscheme.pk</p>
      <button onclick="window.print()">Print Slip</button>
    </div>
  </div>
</body>
</html>
