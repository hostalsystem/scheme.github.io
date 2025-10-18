<?php
session_start();
include 'db.php';

// If student is logged in
if(!isset($_SESSION['student_logged_in'])){
    echo "<h3>Please login to check your result.</h3>";
    exit();
}

// Get student ID
$student_id = $_SESSION['student_id'];

// Fetch results for this student
$query = "SELECT * FROM results WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $query);
?>

<h2>Your Results</h2>

<?php
if(mysqli_num_rows($result) == 0){
    echo "<p>No results found yet. Please wait for admin to add results.</p>";
} else {
    echo "<table border='1' cellpadding='10' cellspacing='0'>
            <tr>
                <th>Subject</th>
                <th>Marks Obtained</th>
                <th>Total Marks</th>
                <th>Grade</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
                <td>".$row['subject']."</td>
                <td>".$row['marks_obtained']."</td>
                <td>".$row['total_marks']."</td>
                <td>".$row['grade']."</td>
              </tr>";
    }
    echo "</table>";
}
?>

<style>
table { width:100%; border-collapse:collapse; margin-top:10px; }
th, td { border:1px solid #ccc; padding:8px; text-align:center; }
th { background:#007bff; color:white; }
</style>
