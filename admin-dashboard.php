<?php
session_start(); // Only here, once per request
if(!isset($_SESSION['admin_logged_in'])){
    header("Location: ../admin-login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Laptop Scheme</title>
<link rel="stylesheet" href="../admin-dashboard.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
  <div class="logo">
    <a href="../index.html">Laptop Scheme</a>
  </div>
  <ul class="nav-links">
    <li><a href="../index.html">Home</a></li>
    <li><a href="../application.html">Apply Now</a></li>
    <li><a href="../student-login.html">Student Login</a></li>
    <li><a href="admin-dashboard.php" class="active">Admin</a></li>
    <li><a href="../check-result.html">Check Result</a></li>
    <li><a href="../contact.html">Contact</a></li>
    <li><a href="admin-logout.php">Logout</a></li>
  </ul>
  <div class="menu-toggle" onclick="toggleMenu()">☰</div>
</nav>

<!-- Dashboard -->
<div class="dashboard-container">
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="admin-dashboard.php?tab=manage-results">Manage Results</a></li>
      <li><a href="admin-dashboard.php?tab=set-test-date">Set Test Dates</a></li>
      <li><a href="admin-dashboard.php?tab=view-applications">View Applications</a></li>
    </ul>
  </div>

  <div class="dashboard-content">
    <?php
    // Load tab content dynamically
    if(isset($_GET['tab'])){
        $tab = $_GET['tab'];
        if($tab == 'manage-results'){
            include 'manage-results.php';
        } elseif($tab == 'set-test-date'){
            include 'set-test-date.php';
        } elseif($tab == 'view-applications'){
            include 'view-applications.php';
        } else {
            echo "<h3>Welcome to Admin Dashboard</h3>";
        }
    } else {
        echo "<h3>Welcome to Admin Dashboard</h3>";
    }
    ?>
  </div>
</div>

<script>
function toggleMenu() {
  document.querySelector('.nav-links').classList.toggle('show');
}
</script>

</body>
</html>
