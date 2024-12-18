<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
 if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];

    

    $sql_student = "SELECT S_ID, A_ID FROM student WHERE username = '$session_id'";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0) {
       
        $row_student = $result_student->fetch_assoc();
        $student_id = $row_student['S_ID'];
	$A_id = $row_student['A_ID'];


// Assuming you have a form with a datetime input field named "datetime"
        $datetime = $_POST['datetime'];

// Set the initial status as needed
        $status = "Pending"; 

        // Update the sick leave table
        $sql = "INSERT INTO session (Time, Status, S_ID, A_ID) VALUES ('$datetime', '$status', '$student_id', '$A_id')";
        if ($conn->query($sql) === TRUE) {
           
        header("Location: Stu_Session.php?error=0");
        } else {
           header("Location: Stu_Session.php?error=1");
        }
    } 
}

$conn->close();
?>

