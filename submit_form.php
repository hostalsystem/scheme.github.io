<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect text inputs
    $full_name   = $_POST['full_name'];
    $father_name = $_POST['father_name'];
    $institute   = $_POST['institute'];
    $course      = $_POST['course'];
    $contact     = $_POST['contact'];
    $address     = $_POST['address'];

    // Folder to store uploads
    $uploadDir = "uploads/";

    // Create uploads folder if not exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle student picture upload
    $studentPicName = "";
    if (isset($_FILES['student_pic']['name']) && $_FILES['student_pic']['name'] != "") {
        $studentPicName = time() . "_" . basename($_FILES['student_pic']['name']);
        $targetFileStudent = $uploadDir . $studentPicName;
        move_uploaded_file($_FILES['student_pic']['tmp_name'], $targetFileStudent);
    }

    // Handle payment screenshot upload
    $paymentPicName = "";
    if (isset($_FILES['payment_pic']['name']) && $_FILES['payment_pic']['name'] != "") {
        $paymentPicName = time() . "_" . basename($_FILES['payment_pic']['name']);
        $targetFilePayment = $uploadDir . $paymentPicName;
        move_uploaded_file($_FILES['payment_pic']['tmp_name'], $targetFilePayment);
    }

    // Insert into database
    $query = "INSERT INTO students 
             (full_name, father_name, institute, course, contact, address, student_pic, payment_pic, status) 
             VALUES 
             ('$full_name', '$father_name', '$institute', '$course', '$contact', '$address', '$studentPicName', '$paymentPicName', 'pending')";

    if (mysqli_query($conn, $query)) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

} else {
    echo "Invalid request method.";
}
?>
