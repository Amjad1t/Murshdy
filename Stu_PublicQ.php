
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
$sql_student_info = "SELECT S_ID,A_ID FROM student WHERE username = '$session_username'";
 $result_student_info = $conn->query($sql_student_info);}

if ($result_student_info->num_rows>0) {
    $row_student_info = $result_student_info->fetch_assoc();
$student_id = $row_student_info['S_ID'];
$A_id = $row_student_info['A_ID'];
}
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
<meta name="author" content="Eythar Alghamdi">
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
<a href="Stu_PublicQ.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
<img src="./images/question_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Public questions
</a>
</li>



<li>
<a href="Stu_Directmessage.php" class="nav-link link-body-emphasis">
<img src="./images/message_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> Send a New Public Question </h7>
  </div>
  <div class="card-body">

     
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="S_ID" id="S_ID" value="<?php $_SESSION['user_id']; ?>">

  <div class="form-group row">
<label id="message" for="name" class="col-sm-2 col-form-label">Your Question: </label>
    <div class="col-sm-10">
      <textarea rows="7" class="form-control" name="message" id="message" placeholder="Enter your question" required> </textarea>
    </div>
  </div><br>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="Send_Message" value="Send_Message" class="btn btn-primary" style="background-color: #04AA6D; border: red;">Send Message </button>
    </div>
  </div>
</form>
<?php

# Assigning user data to variables for easy access later.
if (isset($_POST['message'])) { // Check if 'message' is set in the POST data
    $Msg = $_POST['message'];
	 $Time = date("Y-m-d H:i:s");
   
    $Status='Unanswered';
    // Performing insert query execution
    $sql = "INSERT INTO message (S_ID,A_ID,Content,Send_Time,Status) VALUES ('$student_id',$A_id,'$Msg','$Time','$Status')";
  if ($conn->query($sql) === TRUE) {
        echo "<script>alert('The question has been sent successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    // Close connection
   
}
?>

</div>
</div>
<!-- Cards End HERE --> 


<!-- Cards start HERE -->
<div class="card  w-90 d-block" style="margin: 20px 20px 60px 20px ; " >
<div class="card-header" style="font-weight: 500;">
<h7> Your Public Question </h7>
</div>
<div class="card-body">

<div class="row">
  
      
<?php
    // Retrieve and display messages from the database
	$sql = "SELECT * FROM message WHERE S_ID = '$student_id'";
    // Adjust SQL query based on your database schema
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
				
            echo "<div class='col-sm-6'>";    
            echo "  <div class='card' style='margin: 10px 10px 10px 10px ; '>";
			echo "  <div class='card-body'>";
            echo "  <h6 class='card-text'> Your Question: " . "</h6>"; 
            echo "   <p class='card-text'>" . $row['Content'] . "</p>"; 
			echo "  <h6 class='card-text'> Advisor's Reply: </h6>"; // Displaying student's reply
            echo "   <p class='card-text'>" . $row['Reply'] . "</p>";
            echo "  </div>";
            echo "  </div>";
            echo "</div>";
        }
    } else {
        echo "No question found.";
    }

    // Close database connection
    mysqli_close($conn);
?>



</div>

</div>
</div>


<!-- Cards End HERE --> 
</div>
</main>
</body>
</html>