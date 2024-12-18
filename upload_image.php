
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

// Database connection

$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   
 if (isset($_SESSION['user_id'])) {
    $session_username = $_SESSION['user_id'];
$sql_advisor_info = "SELECT A_ID FROM advisor WHERE username = '$session_username'";
$result_advisor_info = $conn->query($sql_advisor_info);

if ($result_advisor_info->num_rows > 0) {
    $row_advisor_info = $result_advisor_info->fetch_assoc();
    $advisor_id = $row_advisor_info['A_ID'];


       
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]); 
 
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

       $content = $_POST['details']; 
        $name = $_POST['name'];  
        $upload_date = date("Y-m-d H:i:s");
      
        $sql = "INSERT INTO activity (A_ID, image_file,Download_time, Content, Ac_name) VALUES ('$advisor_id', '$target_file','$upload_date', '$content', ' $name ')";

        if ($conn->query($sql) === TRUE) {
           
        header("Location: Adv_Activities.php?error=0");
        } else {
           header("Location: Adv_Activities.php?error=1");
        }
}
}
 }

$conn->close();


