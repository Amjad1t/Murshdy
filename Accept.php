<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

$servername = "localhost";
$username = "root";
$password = "your_password";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve advisor information based on the username
$session_username = $_SESSION['user_id'];
$sql_advisor_info = "SELECT A_ID FROM advisor WHERE username = '$session_username'";
$result_advisor_info = $conn->query($sql_advisor_info);

if ($result_advisor_info->num_rows > 0) {
    $row_advisor_info = $result_advisor_info->fetch_assoc();
    $advisor_id = $row_advisor_info['A_ID'];

    // Check if both S_ID and Si_ID are provided in the URL
    if (isset($_GET['id']) && isset($_GET['Se_id'])) {
        $student_id = $_GET['id'];
        $session_id = $_GET['Se_id'];

        // Check if the form is submitted for status modification
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process the form submission and update the status in the database
            $new_status = $_POST['new_status'];

             $sql_update_status = "UPDATE session SET status = '$new_status' WHERE S_ID = '$student_id' AND Se_ID = '$session_id' AND A_ID = '$advisor_id'";
            if ($conn->query($sql_update_status) === TRUE) {
                header("Location: Adv_Session.php?error=0");
                // Add JavaScript to trigger an alert after redirect
                echo "<script>";
                echo "alert('Status updated successfully');"; // This line triggers the success alert
                echo "</script>";
            } else {
                header("Location: Adv_Session.php?error=1");
                // Add JavaScript to trigger an alert after redirect
                echo "<script>";
                echo "alert('Something went wrong, Status not updated.');"; // This line triggers the error alert
                echo "</script>";
            }
        }

        // Retrieve sick leave information for displaying in the form
		
        $sql_sick_leave_info = "SELECT student.Name AS student_name, session.Time, session.Status
                                FROM session
                                JOIN student ON session.S_ID = student.S_ID
                                WHERE student.S_ID = '$student_id' AND session.Se_ID = '$session_id' AND session.A_ID = '$advisor_id'";
        $result_sick_leave_info = $conn->query($sql_sick_leave_info);

        if ($result_sick_leave_info->num_rows > 0) {
            $row_session_info = $result_sick_leave_info->fetch_assoc();
            $student_name = $row_session_info['student_name'];
            $Time= $row_session_info['Time'];
            $current_status = $row_session_info['Status'];
           
        } else {
            echo "Session not found or not assigned to the advisor.";
            exit();
        }
    } else {
        echo "Both Student ID (S_ID) and session_info ID (Se_ID) must be provided.";
        exit();
    }
} else {
    echo "Advisor not found.";
    exit();
}
$conn->close();
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
<a href="Adv_Sickleaves.php" class="nav-link link-body-emphasis" >
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; height : 450px;" >
  <div class="card-header" style="font-weight: 500;">
    <h7> Modify request status </h7>
  </div>
  <div class="card-body" >
 <h5>Modify Session Status for <?php echo $student_name; ?></h5>
 <br>
    <p>Time and Date: <?php echo $Time; ?></p>
    <p>Current Status: <?php echo $current_status; ?></p>
	
	<?php
    
 
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            // Display an error message in red
            echo '<script>alert("Something goes wrong, Status not updated.")</script>';
        } elseif (isset($_GET['error']) && $_GET['error'] == 0) {
            echo '<script>alert("Status updated successfully")</script>';
        }
		if (!empty($file_path)) {
        echo "<p>Download File: <a href='$file_path' download>Download</a></p>";
    }
    ?>
    
	
      <form method="post" action="">
	<div class="form-group row">
    <label for="new_status" class="col-sm-2 col-form-label">Choose Action:</label>
    <div class="col-sm-10">
      <select class="form-control" name="new_status" required>
            <option value="Accept">Accept</option>
            <option value="Reject">Reject</option>
        </select>
        <br><br>
        <button type="submit" class="btn-secondary">Submit</button>
    </form>
</div>
</div>
</div>




</div>
<!-- Cards End HERE --> 

</main>
</body>
</html>





























