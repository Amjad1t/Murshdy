<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

<!-- CSS files -->
<link rel="stylesheet" href="./style/css/bootstrap.css">
<link rel="stylesheet" href="./style/JS/bootstrap.JS">
<link rel="stylesheet" href="./style/Mainpage.css" >


<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
<link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Meta Infos -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Acadimic Advising system">

<title>Murshdy</title>


<link rel="icon" type="image/png" href="./images/logo-transparent.png">
<!-- Favicons -->    


</head>
 
<body class="bg-body-secondary">


<!-- sidebar start HERE --> 
<main class="d-flex flex-nowrap" >

<div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 280px; background-color: #3d9970; height: 2500px;">

<a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
<div style="margin-left:50px">
<img src="./images/logo-white.png" width="150" > </>
</a>
</div>
<hr>

<ul class="nav nav-pills flex-column mb-auto" style="margin-top:20px;">

<li class="nav-item">
<a href="Stu_PerInfo.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
<img src="./images/user_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Personal Information
</a>
</li>

<li>
<a href="Stu_Activities.php" class="nav-link link-body-emphasis">
<img src="./images/act_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Activities
</a>
</li>

<hr>
<li class="nav-item">
 <a href="Stu_Schedule.php" class="nav-link link-body-emphasis">
<img src="./images/schedule_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Schedule 
</a>
</li>
      

<li>
<a href="Stu_Sickleaves.php" class="nav-link link-body-emphasis">
<img src="./images/file_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Sick leaves
</a>
</li>


<li>
<a href="Stu_Session.php" class="nav-link link-body-emphasis">
<img src="./images/session_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Session
</a>
</li>

<hr>
<li>
<a href="Stu_PublicQ.php" class="nav-link link-body-emphasis">
<img src="./images/question_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Public questions
</a>
</li>



<li>
<a href="Stu_Directmessage.php" class="nav-link link-body-emphasis">
<img src="./images/message
_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Direct Message
</a>
</li>

<li style="margin-top:70px">
<a href="logout.php" class="nav-link link-body-emphasis">
<img src="./images/log_out_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Log out
</a>
</li>

</ul>
</div>
<!-- sidebar End HERE --> 

<?php
session_start();

// Redirect to the login page if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
// Connect to the database
$servername = "localhost";
$username = "root@localhost";
$password = "your_password";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_SESSION['user_id']; 
$sql_student = "SELECT Name, Major, Phone, Email, A_ID FROM student WHERE username = '$username'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $row_student = $result_student->fetch_assoc();

    // Fetch advisor data based on the student's AdvisorID
    $advisor_id = $row_student['A_ID'];
    $sql_advisor = "SELECT Name AS AdvisorName, Email AS AdvisorEmail FROM advisor WHERE A_ID = '$advisor_id'";
    $result_advisor = $conn->query($sql_advisor);

    // Check if an advisor is found
    if ($result_advisor->num_rows > 0) {
        $row_advisor = $result_advisor->fetch_assoc();
        $advisor_name = $row_advisor['AdvisorName'];
        $advisor_email = $row_advisor['AdvisorEmail'];
		}
?>

<!-- Cards start HERE -->

<div class="vstack overflow-auto">
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; height : 450px;" >
  <div class="card-header" style="font-weight: 500;">
    <h7> Student information </h7>
  </div>
  <div class="card-body">
<p class="card-text">Personal information</p><hr>
            <p class="card-text"><b>Name: </b><?php echo $row_student['Name']; ?> </p>
            <p class="card-text"><b>Major:</b> <?php echo $row_student['Major']; ?> </p>
			 <p class="card-text"><b>Advisor Name:</b> <?php echo $advisor_name; ?> </p>
            <p class="card-text"><b>Advisor Email: </b><?php echo $advisor_email; ?></p>  

            <p class="card-text" style="margin-top: 50px;">Contact information</p><hr>
            <p class="card-text"><b>Mobile:</b> <?php echo $row_student['Phone']; ?> </p>
            <p class="card-text"><b>Email: </b><?php echo $row_student['Email']; ?></p>  

</div>
</div>
<?php
} else {
    echo "User not found!";
}

// Close the database connection
$conn->close();
?>

<!-- Cards End HERE --> 

</main>
</body>
</html>