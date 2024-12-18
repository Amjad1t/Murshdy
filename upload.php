
<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
 if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];

    $sql_student = "SELECT S_ID,A_ID FROM student WHERE username = '$session_id'";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0) {
       
        $row_student = $result_student->fetch_assoc();
        $student_id = $row_student['S_ID'];
		$A_id = $row_student['A_ID'];

       
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]); 
 
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // File uploaded successfully, update database
        $upload_date = date("Y-m-d H:i:s");
        $status = "Pending";  // You can set the initial status as needed

        // Update the sick leave table
        $sql = "INSERT INTO sick_leave (S_ID, file_path, Date, Status,A_ID) VALUES ('$student_id', '$target_file', '$upload_date', '$status','$A_id')";

        if ($conn->query($sql) === TRUE) {
           
        header("Location: Stu_Sickleaves.php?error=0");
        } else {
           header("Location: Stu_Sickleaves.php?error=1");
        }
    } 
}
 }

$conn->close();


?>
