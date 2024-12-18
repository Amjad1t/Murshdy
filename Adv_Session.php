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


$sql_files = "SELECT student.Name AS student_name,student.S_ID, session.Time,session.Se_ID, session.Status
              FROM session
              JOIN student ON session.S_ID = student.S_ID 
			   WHERE student.A_ID = '$advisor_id'";
$result_files = $conn->query($sql_files);
 }}
?>



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


<!-- Favicons -->    

<link rel="icon" type="image/png" href="./images/logo-transparent.png">


</head>
 
<body class="bg-body-secondary">


<!-- sidebar start HERE --> 
<main class="d-flex flex-nowrap" >

<div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 280px; background-color: #3d9970; height: 2500px;">
<div style="margin-left:50px">
<img src="./images/logo-white.png" width="150" > </>
</a>
</div>
<hr>

<ul class="nav nav-pills flex-column mb-auto" style="margin-top:20px;">

<li class="nav-item">
<a href="Adv_PerInfo.php" class="nav-link link-body-emphasis">
<img src="./images/user_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Personal Information
</a>
</li>

<li>
<a href="Adv_Activities.php" class="nav-link link-body-emphasis">
<img src="./images/act_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Activities
</a>
</li>

<li>
<a href="Adv_StuList.php" class="nav-link link-body-emphasis">
<img src="./images/list_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Student List
</a>
</li>

<hr>
<li class="nav-item">
 <a href="Adv_Schedule.php" class="nav-link link-body-emphasis">
<img src="./images/schedule_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Schedule 
</a>
</li>
      

<li>
<a href="Adv_Sickleaves.php" class="nav-link link-body-emphasis">
<img src="./images/file_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Sick leaves
</a>
</li>


<li>
<a href="Adv_Session.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
<img src="./images/session_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Session
</a>
</li>

<hr>
<li>
<a href="Adv_PublicQ.php" class="nav-link link-body-emphasis">
<img src="./images/question_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Public questions
</a>
</li>



<li>
<a href="Adv_Directmessage.php" class="nav-link link-body-emphasis">
<img src="./images/message
_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Direct Message
</a>
</li>

<li style="margin-top:30px">
<a href="logout.php" class="nav-link link-body-emphasis">
<img src="./images/log_out_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Log out
</a>
</li>

</ul>
</div>
<!-- sidebar End HERE --> 


<!-- Cards start HERE -->

<div class="vstack overflow-auto">
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; height : 500px;" >
                <div class="card-header" style="font-weight: 500;">
                    <h7> Session Requests</h7>
                </div>
                <div class="card-body">
                   
                    <table>
                        <thead>
                            <tr>
                                <th>Student name</th>
                                <th>Date and time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
<?php
        if ($result_files->num_rows > 0) {
                while ($row = $result_files->fetch_assoc()) {
        echo "<tr>";
	echo "<td>" . $row['student_name']. " </td>";
	echo "<td>" . $row['Time']. " </td>";
	//echo "<td>" . $row['Status']. " </td>";
    $status = strtolower($row['Status']);
    $status_color = '';
    switch ($status) {
        case 'accept':
            $status_color = '#8BC34A'; 
            break;
        case 'reject':
            $status_color = '#d84315'; 
            break;
        case 'pending':
            $status_color = '#FFB300'; 
            break;
        default:
            $status_color = 'black'; 
            break;
    }
    
    echo "<td style='color: $status_color;'>" . $row['Status'] . "</td>";
	echo "<td><a href='Accept.php?id={$row['S_ID']}&Se_id={$row['Se_ID']}'>Modify Status</a></td>";
    }
} else {
    echo "No new session requests.";
}

?>
                        </tbody>
                    </table>
                </div>
            </div>

<!-- Cards End HERE --> 



</main>
<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 0) {
            echo "<script>alert('Status updated successfully');</script>";
        } elseif ($_GET['error'] == 1) {
            echo "<script>alert('Something went wrong, Status not updated.');</script>";
        }
    }
    ?>
</body>
</html>