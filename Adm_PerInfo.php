<?php
session_start();

// Redirect to the login page if the user is not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data based on the current user
$username = $_SESSION['user_id']; 
$sql = "SELECT  Adm_ID, Adm_Name, password, Adm_Email, Adm_Mobile, AdmOffice_Number,AdmOffice_Phone, username FROM Admin WHERE username = '$username'";

$result = $conn->query($sql) ;


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
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
<img src="./images/logo-white.png" width="200"> </>
</a>
<hr>

<ul class="nav nav-pills flex-column mb-auto" style="margin-top:20px;">

<li class="nav-item">
<a href="Adm_PerInfo.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
<img src="./images/user_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Personal Information
</a>
</li>
<hr>

<li>
<a href="Adm_Stu.php" class="nav-link link-body-emphasis">
<img src="./images/act_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Students
</a>
</li>


<li class="nav-item">
 <a href="Adm_Adv.php" class="nav-link link-body-emphasis">
<img src="./images/schedule_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Advisors
</a>
</li>
      


<li  style="margin-top:250px">
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; ">
  <div class="card-header" style="font-weight: 500;">
    <h7> My Information </h7>
  </div>
  <div class="card-body">

<p class="card-text"> <b> Admin ID: </b> <?php echo $row['Adm_ID']; ?>     </p>   
<p class="card-text"> <b> Admin Username: </b> <?php echo $row['username']; ?>     </p>   
<p class="card-text"> <b>Admin Name: </b><?php echo $row['Adm_Name']; ?>  </p> 
<p class="card-text"> <b>Admin Email: </b> <?php echo $row['Adm_Email']; ?> </p>
<p class="card-text"> <b>Admin Mobile: </b><?php echo $row['Adm_Mobile']; ?> </p>
<p class="card-text"> <b>Office Number: </b><?php echo $row['AdmOffice_Number']; ?></p>
<p class="card-text"> <b>Office Phone: </b><?php echo $row['AdmOffice_Phone']; ?> </p>

</div>
</div>

</div>
<!-- Cards End HERE --> 

</main>
</body>
</html>


<?php
} else {
    echo "User not found!";
}

// Close the database connection
$conn->close();
?>






