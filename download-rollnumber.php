
<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = "SELECT * FROM students WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $student = mysqli_fetch_assoc($result);

        // Headers for download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=RollNumberSlip_'.$student['roll_no'].'.txt');

        echo "------- Roll Number Slip -------\n";
        echo "Name: ".$student['full_name']."\n";
        echo "Father Name: ".$student['father_name']."\n";
        echo "Roll Number: ".$student['roll_no']."\n";
        echo "Course: ".$student['course']."\n";
        echo "--------------------------------\n";
        exit();
    } else {
        echo "Invalid Student ID!";
    }
} else {
    echo "No Student ID provided!";
}
?>
