<?php
include 'db.php'; // Only include DB connection

// Admin check using the session already started in admin-dashboard.php
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../admin-login.html");
    exit();
}
?>


<h2>Manage Student Results</h2>

<!-- Display success/error messages -->
<?php
if(isset($_SESSION['success_msg'])){
    echo '<div class="alert success">'.$_SESSION['success_msg'].'</div>';
    unset($_SESSION['success_msg']);
}
if(isset($_SESSION['error_msg'])){
    echo '<div class="alert error">'.$_SESSION['error_msg'].'</div>';
    unset($_SESSION['error_msg']);
}
?>

<form action="add-results.php" method="POST">
    <label>Select Student:</label>
    <select name="student_id" required>
    <option value="">--Select Student--</option>
    <?php
    $students = mysqli_query($conn, "SELECT id, full_name, course FROM students");
    while($s = mysqli_fetch_assoc($students)){
        echo "<option value='".$s['id']."'>".$s['full_name']." - ".$s['course']."</option>";
    }
    ?>
</select>
    </select>
    <br><br>

    <input type="text" name="subject" placeholder="Subject" required>
    <input type="number" name="marks_obtained" placeholder="Marks Obtained" required>
    <input type="number" name="total_marks" placeholder="Total Marks" required>
    <input type="text" name="grade" placeholder="Grade" required>
    <br><br>

    <button type="submit">Submit Result</button>
</form>

<style>
/* Simple styles to fit your dashboard */
form input, form select, form button { display: block; width: 100%; margin: 8px 0; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
form button { background: #007bff; color: white; border: none; cursor: pointer; }
form button:hover { background: #0056b3; }
.alert { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
.success { background: #d4edda; color: #155724; }
.error { background: #f8d7da; color: #721c24; }
</style>
