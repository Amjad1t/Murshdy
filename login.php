<?php
session_start();

// Establish database connection
$conn = new mysqli("localhost", "root", "", "murshdy");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$advisor_query = "SELECT * FROM advisor WHERE username='$username' AND password='$password'";
$advisor_result = $conn->query($advisor_query);

if ($advisor_result && $advisor_result->num_rows > 0) {
    $_SESSION['user_id'] = $username;
    header("Location: Adv_PerInfo.php");
    exit();
}

$student_query = "SELECT * FROM student WHERE username='$username' AND password='$password'";
$student_result = $conn->query($student_query);

if ($student_result && $student_result->num_rows > 0) {
    $_SESSION['user_id'] = $username;
	
    header("Location: Stu_PerInfo.php");
    exit();
}

$admin_query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$admin_result = $conn->query($admin_query);


if ($admin_result && $admin_result->num_rows > 0) {
    $_SESSION['user_id'] = $username;
    header("Location: Adm_PerInfo.php");
    exit();
}


header("Location: index.php?error=1");
exit();

$conn->close();
?>
