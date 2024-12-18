
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

<link rel="icon" type="image/png" href="./images/logo-transparent.png">
<!-- Favicons -->    


</head>
 
<body class="bg-body-secondary">


<!-- sidebar start HERE --> 
<main class="d-flex flex-nowrap" >

<div class="d-flex flex-column flex-shrink-0 p-3 " style="width: 280px; background-color: #3d9970; height: 2500px;">

<a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
<div style="margin-left:50px">
<img src="./images/logo-white.png" width="150"> 
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
 <a href="Stu_Schedule.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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


<!-- Cards start HERE -->

<div class="vstack overflow-auto">
<div class="card w-90 d-block" style="margin: 60px 20px 0px 20px; min-height: 200px;">
  <div class="card-header" style="font-weight: 500;">
    <h7> Deletion and addition form </h7>
  </div>
  <div class="card-body">
<div class="instructions">
        <h5>Instructions</h5>
        <p>Step 1: Download the registration form below <a href="form.pdf" download="form.pdf" target="_blank">Download PDF</a>.</p>
        <p>Step 2: Fill out the form with the required information and submit it <b> again. </b></p>
    </div>
 <div class="card-body" align="center">
  </div>
  </div>
</div>
 
  <!-- Option 2: Allow user to attach a file -->
  

<div class="card w-90 d-block" style="margin: 20px 20px 0px 20px; min-height: 380px;">
  <div class="card-header" style="font-weight: 500;">
    <h7> Submit the form </h7>
  </div>
  <div class="card-body" align="center">
  <div class="upload-container">
  <?php  
        session_start(); 
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            // Display an error message in red
            echo '<script>alert("Something goes wrong, a schedule change request was not uploaded..")</script>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 0) {
            echo '<script>alert("The schedule change request has been uploaded successfully.")</script>';
        }
    ?>
    <form action="upload_form.php" method="post" enctype="multipart/form-data">
        <!-- Pass the session ID as a hidden input field -->
        <input type="hidden" name="student_id" value="<?php echo $_SESSION['user_id']; ?>">
      

        <label for="file">Choose File:</label>
        <input type="file" name="file" required>
	<p class="upload-info">Supported file format: PDF or DOCX </p>
    
<textarea class="styled-textarea" id="details" name="details" placeholder="Enter your note"></textarea>
<br>
<button style="margin: 20px 10px 10px 10px" type="submit" class="btn-secondary">Submit</button>

</div>
  
  
	
</div>
</div>




<div class="card  w-90 d-block" style="margin: 20px; height : 500px;" >
  <div class="card-header" style="font-weight: 500;">
    <h7> My requests to change the schedule</h7>
  </div>
  <div class="card-body">

<div class="instructions">
      
        <div class="line"> - Once the request is submited, the status <span style="color: #FFB300;"><b>“Pending”</b></span> and the status <span style="color: #8BC34A;"><b>“Complete”</b></span>. Your advisor has sent the form to the college registrar. </div>
        <div class="line"> - If the status is  <span style="color:#d84315;"><b>“Incomplete”</b></span> the schedule change request. You can check the form and your available times again.</div>
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
    $sql_requests = "SELECT file_name, Date, Status FROM scheduled WHERE S_ID = '$student_id'";
    $result_requests = $conn->query($sql_requests);
 
?>
<table>
    <thead>
        <tr>
            <th>File</th>
            <th>Download File</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
	
        <?php
        if ($result_requests->num_rows > 0) {
            while ($row_request = $result_requests->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row_request['file_name'] . "</td>";
                echo "<td><a href='" . $row_request["file_name"] . "' target='_blank'>Download</a></td>";
                echo "<td>" . $row_request['Date'] . "</td>";
                
                // Conditional formatting based on status
                $status = strtolower($row_request['Status']);
                $status_color = '';
                switch ($status) {
                    case 'complete':
                        $status_color = '#8BC34A';
                        break;
                    case 'incomplete':
                        $status_color = '#d84315';
                        break;
                    case 'pending':
                        $status_color = '#FFB300';
                        break;
                    default:
                        $status_color = ''; // No specific color for other statuses
                }
                
                echo "<td style='color: $status_color;'>" . $row_request['Status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No requests found.</td></tr>";
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

</div>





<!-- Cards End HERE --> 

</main>
</body>
</html>