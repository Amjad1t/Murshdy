<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

// Database connection

$servername = "localhost";
$username = "root";
$password = "";
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


$sql_files = "SELECT * FROM student WHERE student.A_ID = '$advisor_id'";
              
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
<a href="Adv_PerInfo.php" class="nav-link link-body-emphasis" >
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
<a href="Adv_StuList.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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
<a href="Adv_Session.php" class="nav-link link-body-emphasis">
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

<div class="card  w-90 d-block" style="margin: 20px 20px 60px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> Students list </h7>
  </div>
  <div class="card-body">
 

   
	<table>
     <thead>
            <tr>
                <th>Student Name</th>
				<th>Student ID</th>
                <th>Major</th>
                <th>Academic Record</th>
				 <th>Plan</th>
				 <th>Schedule</th>
				 <th>Attendance Record</th>
				  <th>Notes</th>
				 
              
            </tr>
        </thead>
        <tbody>
		
            <?php
            if ($result_files->num_rows > 0) {
                while ($row_file = $result_files->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>". $row_file['Name'] . "</td>";
					echo "<td>". $row_file['username']."</td>"; 
                    echo "<td>".$row_file['Major'] . "</td>";		
                    echo "<td><a href='javascript:void(0)' onclick='onclicking()'>Record</a></td>";
                echo "<td>";
				echo '<a href="' . $row_file['Plan'] . '" target="_blank"> Plan</a>';
					  echo "</td>";
                      echo "<td><a href='javascript:void(0)' onclick='onclicking()'>Schedule</a></td>";
                      echo "<td><a href='javascript:void(0)' onclick='onclicking()'>Attendance</a></td>";
                      
					echo "<td><a href='notes.php?id={$row_file['S_ID']}&A_id={$row_file['A_ID']}'>Notes</a></td>";
					 
                    echo "</tr>";
					
                }
            } else {
                echo "<tr><td colspan='4'>No uploaded files found.</td></tr>";
            }
			
			
            ?>
        </tbody>
    </table>

    <script>
    function onclicking() {
        alert("This is a new student ! This student has no academic record,schedule, and attendance record because she/he a new student and did not assign to any course yet!");
    }
    <?php
    
       
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 0) {
            echo "<script>alert('Status updated successfully');</script>";
        } elseif ($_GET['error'] == 1) {
            echo "<script>alert('Something went wrong, Status not updated.');</script>";
        }
    }
 
    
    ?>
</script>
</div>
</div>




</div>
<!-- Cards End HERE --> 

</main>
</body>
</html>