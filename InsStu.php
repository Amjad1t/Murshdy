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
    $username = $_POST['username'];
    $Name = $_POST['Name'];
    $Password = $_POST['password'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Department = $_POST['Major'];
    $AdvisorID = $_POST['A_ID']; 
    // Plan image file names
    $planImages = array(
        "Artificial intelligence" => "./images/AI.jpg",
        "Computer Science" => "./images/CS.jpg",
        "Cyber Security" => "./images/CySec.jpg",
        "Information System" => "./images/IS.jpg"
    );   
    // Get the plan image based on the selected major
    $Plan = isset($planImages[$Department]) ? $planImages[$Department] : '';
    // Performing insert query execution
    $sql = "INSERT INTO student (username, Name, Password, Email, Phone, Major, A_ID, Plan,Adm_ID) 
            VALUES ('$username', '$Name', '$Password', '$Email', '$Phone', '$Department', '$AdvisorID', '$Plan','$admin_id')";
    if ($conn->query($sql) === TRUE) {
        header("Location: Adm_Stu.php?error=0");
        exit(); // Ensure script stops execution after redirection
    } else {
        header("Location: Adm_Stu.php?error=1");
        exit(); // Ensure script stops execution after redirection
    }
}}
$conn->close();
?>
