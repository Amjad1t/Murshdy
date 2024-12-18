
<?php
include("db_connection.php");

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

<a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
<div style="margin-left:50px">
<img src="./images/logo-white.png" width="150" > </>
</a>
</div>
<hr>

<ul class="nav nav-pills flex-column mb-auto" style="margin-top:20px">

<li class="nav-item">
<a href="Stu_PerInfo.php" class="nav-link link-body-emphasis" >
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
<a href="Stu_Sickleaves.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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


<!-- Cards start HERE -->

<div class="vstack overflow-auto">
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; height : 500px;" >
  <div class="card-header" style="font-weight: 500;">
    <h7> Submit a new sick leave </h7>

  </div>
  
<div class="card-body" align="center">

<div class="download-box" id="dropArea" ondrop="dropHandler(event)" ondragover="dragOverHandler(event)">
    <img src="./images/download_icon.png" class="bi pe-none me-2" width="50" height="50"></img>
    <?php  
        session_start(); 
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            // Display an error message in red
            echo '<script>alert("Something goes wrong, Your sick leave was not uploaded..")</script>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 0) {
            echo '<script>alert("The sick leave has been uploaded successfully.")</script>';
        }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      
        <input type="hidden" name="student_id" value="<?php echo $_SESSION['user_id']; ?>">
        <br>

        <label for="file">Choose File:</label>
        <input type="file" name="file" required>
        <br><br>
<p class="card-text" style="font-size:10px">Supported formates: JPEG, PNG, PDF, PSD, AI, Word </p>
</div>
<div class="card-body" align="center">
        <input type="submit" value="Upload">
    </form>
    </div>
	</div>
   
   
</div>



<div class="card  w-90 d-block" style="margin: 20px 20px 60px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> My sickleaves </h7>
  </div>
  <div class="card-body">
   
<div class="instructions">
        
        <div class="line"> - Once the request is uploaded, the status <span style="color: #FFB300;"><b>“Pending”</b></span> and the status <span style="color: #8BC34A;"><b>“Accept”</b></span> . You can now discuss it with your course instructor.</div>
        <div class="line"> - If the status is  <span style="color:#d84315;"><b>“Reject”</b></span> the sick leave request. You can check the sick leave again.</div>
    </div>       
<?php

$session_id = $_SESSION['user_id'];

// Retrieve student ID based on session ID
$sql_student = "SELECT S_ID FROM student WHERE username = '$session_id'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    $row_student = $result_student->fetch_assoc();
    $student_id = $row_student['S_ID'];

    // Retrieve sick leave requests for the student
    $sql_requests = "SELECT file_path, Date, Status FROM sick_leave WHERE S_ID = '$student_id'";
    $result_requests = $conn->query($sql_requests);
	
 
?>
<table>
    <thead>
        <tr>
            <th>File name</th>
            <th>Download File</th>
            <th>Date </th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result_requests->num_rows > 0) {
            while ($row_request = $result_requests->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_request['file_path'] . "</td>";
                echo "<td><a href='" . $row_request["file_path"] . "' target='_blank'>Download</a></td>"; 
                echo "<td>" . $row_request['Date'] . "</td>";
              
                $status = strtolower($row_request['Status']);
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
                echo "<td style='color: $status_color;'>" . $row_request['Status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No sick leave requests found.</td></tr>";
        }
        ?>
    </tbody>
</table>

	<?php
} else {
    echo "Error: Unable to find a matching student for the given session ID.";
}

// Close the database connection
$conn->close();
?>

</div>
</div>



<!-- Cards End HERE --> 

</main>
</body>
</html>