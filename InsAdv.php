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
    // Fetch the username from the session
    $username = $_SESSION['user_id'];

    // Fetch admin data based on the username
    $sql_admin = "SELECT * FROM Admin WHERE username = '$username'";
    $result_admin = $conn->query($sql_admin);

    // Check if admin data is fetched successfully
    if ($result_admin->num_rows > 0) {
        $row_admin = $result_admin->fetch_assoc();
        $admin_id = $row_admin['Adm_ID'];

        // Taking all values from the form data(input)
        $username = $_REQUEST['username'];
        $Name = $_REQUEST['Name'];
        $Password = $_REQUEST['Password'];
        $Email = $_REQUEST['Email'];
        $Phone = $_REQUEST['Phone'];
        $Department = $_REQUEST['Department'];
        $Office_Number = $_REQUEST['Office_Number'];
        $Office_hours = $_REQUEST['Office_hours'];
		

        // Performing insert query execution
        $sql = "INSERT INTO advisor (username, Name, Password, Email, Phone, Department, Office_Number, Office_hours, Adm_ID) 
                VALUES ('$username', '$Name', '$Password', '$Email', '$Phone', '$Department', '$Office_Number', '$Office_hours', '$admin_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: Adm_Adv.php?error=0");
        } else {
            header("Location: Adm_Adv.php?error=1");
        }
    } else {
        // Redirect if admin data is not found
        header("Location: Adm_Adv.php?error=admin_not_found");
    }
} else {
    // Redirect if session user_id is not set
    header("Location: index.php");
}

$conn->close();
?>