<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "your_password"; // Replace with your actual database password
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    // Retrieve advisor ID
    $session_username = $_SESSION['user_id'];
    $sql_advisor_info = "SELECT A_ID FROM advisor WHERE username = '$session_username'";
    $result_advisor_info = $conn->query($sql_advisor_info);

    if ($result_advisor_info->num_rows > 0) {
        $row_advisor_info = $result_advisor_info->fetch_assoc();
        $advisor_id = $row_advisor_info['A_ID'];

        if (isset($_GET['id']) && isset($_GET['m_id'])) {
            // Retrieve parameters from URL
            $student_id = $_GET['id'];
            $message_id = $_GET['m_id'];

            if (isset($_POST['message'])) {
                $msg = $_POST['message'];
                $Time = date("Y-m-d H:i:s");

                // Performing insert query execution
                $sql = "UPDATE message SET Reply = '$msg', Send_Time = '$Time' ,Status = 'answered' WHERE M_ID = '$message_id'";

                if ($conn->query($sql) === TRUE) {
                    header("Location: Adv_PublicQ.php?error=0");
                } else {
                    header("Location: Adv_PublicQ.php?error=1");
                }
            }
        }
    }
}
// Fetch student name and message content
if (isset($_GET['id']) && isset($_GET['m_id'])) {
    $student_id = $_GET['id'];
    $message_id = $_GET['m_id'];

    // Retrieve student name from Student table
    $sql_student_info = "SELECT Name FROM student WHERE S_ID = '$student_id'";
    $result_student_info = $conn->query($sql_student_info);
    if ($result_student_info->num_rows > 0) {
        $row_student_info = $result_student_info->fetch_assoc();
        $student_name = $row_student_info['Name'];
    }

    // Retrieve message content from Message table
    $sql_message_content = "SELECT Content FROM message WHERE M_ID = '$message_id'";
    $result_message_content = $conn->query($sql_message_content);
    if ($result_message_content->num_rows > 0) {
        $row_message_content = $result_message_content->fetch_assoc();
        $message_content = $row_message_content['Content'];
    }
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
<a href="Adv_PublicQ.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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
<a href="#" class="nav-link link-body-emphasis">
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
    <h7> Public Questions </h7>
  </div>
  <div class="card-body">
    <?php  
    // Display student name and message content
    if (isset($student_name) && isset($message_content)) {
        echo "<p><b>Student Name : </b> $student_name</p>";
        echo "<p><b> Question :</b> $message_content</p>";
    }
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        // Display an error message in red
        echo '<script>alert("Something goes wrong, the reply to the question was not uploaded..")</script>';
    } elseif (isset($_GET['error']) && $_GET['error'] == 0) {
        echo '<script>alert("The reply has been uploaded successfully.")</script>';
    }
    ?>
    <form method="post" >
    <div class="form-group row">
        <!-- Hidden input to capture student ID -->
        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
        <!-- Hidden input to capture message ID -->
        <input type="hidden" name="message_id" value="<?php echo $message_id; ?>">
        <label for="message" class="col-sm-2 col-form-label">Answer:</label>
        <div class="col-sm-10">
            <textarea rows="7" class="form-control" name="message" id="message" placeholder="Enter your answer" required></textarea>
        </div>
        <div class="form-group row">
            <div class="col-sm-10" align="center">
                <button  align="center" type="submit" name="Send_Message" value="Send_Message" class="btn btn-primary" style="background-color: #04AA6D; border: red; ">Send Message</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<!-- Cards End HERE --> 

</main>
</body>
</html>
