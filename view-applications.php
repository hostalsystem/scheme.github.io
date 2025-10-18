<?php
include 'db.php';

// Only allow admin
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../admin-login.html");
    exit();
}

// Fetch all students
$applications = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
?>

<h2>View Student Applications</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Father Name</th>
        <th>Institute</th>
        <th>Course</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Student Pic</th>
        <th>Payment Pic</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($applications)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['full_name']; ?></td>
        <td><?php echo $row['father_name']; ?></td>
        <td><?php echo $row['institute']; ?></td>
        <td><?php echo $row['course']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo $row['address']; ?></td>
        <td><img src="../uploads/<?php echo $row['student_pic']; ?>" width="50"></td>
        <td><img src="../uploads/<?php echo $row['payment_pic']; ?>" width="50"></td>
    </tr>
    <?php endwhile; ?>
</table>

<style>
table { width:100%; border-collapse:collapse; }
th, td { border:1px solid #ccc; padding:8px; text-align:center; }
th { background:#007bff; color:white; }
img { border-radius:5px; }
</style>
