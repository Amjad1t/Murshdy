<?php
include("db_connection.php");
session_start();

// Check if the teacher is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Index.php"); // Redirect to the login page if not logged in
    exit;

$session_id = $_SESSION['user_id'];
$sql_student="SELECT S_ID from advisor WHERE username='$session_id'";
$result_student=$conn->query($sql_student);
 if($result_student->num_rows>0){
    $row_student=$result_student->fetch_assoc();
    $student_id= $row_student['S_ID'];
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
<a href="Stu_Activities.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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

<!-- Cards start HERE -->
<div class="vstack overflow-auto">

<div class="card  w-90 d-block" style="margin: 20px 20px 60px 20px ; " >
<div class="card-header" style="font-weight: 500;">
<h7> Activities Announcements </h7>
</div>
<div class="card-body">
<div class="card-group">
<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
$sql = "SELECT * FROM activity"; // Adjust SQL query based on your database schema
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="col">';
        echo '<div class="card h-100">';
        echo '<img src="' . $row['image_file'] . '" class="card-img-top" alt="Activity Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['Ac_name'] . '</h5>';
        echo '<p class="card-text">' . $row['Content'] . '</p>';
		echo'<p class="card-text">'.'<small class="text-body-secondary">'. $row['Download_time'].'</small>'.'</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="col">';
    echo '<div class="card h-100">';
    echo '<div class="card-body"  style="width:650px">';
    echo '<p class="card-text">No activities found.</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Close database connection
mysqli_close($conn);
?>
</div>

</div>


      



           

</div>    
<!-- Cards End HERE --> 

<!-- Image Display Card -->     
</main>
</body>
</html>