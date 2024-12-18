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
$admin_id = $_SESSION['user_id'];

// Fetch admin data based on the admin ID (optional)
$sql_admin = "SELECT * FROM admin WHERE Adm_ID = '$admin_id'";
$result_admin = $conn->query($sql_admin);
$row_admin = $result_admin->fetch_assoc(); 

// Fetch user data based on the current user

//$sql = "SELECT  Adm_ID, Adm_Name, password, Adm_Email, Adm_Mobile, AdmOffice_Number,AdmOffice_Phone, username FROM Admin WHERE username = '$username'";

$sql = "SELECT  A_ID, Name, password, Department, Email, Phone, Office_Number, Office_hours, username FROM advisor";


$result = $conn->query($sql) ;


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
<a href="Adm_PerInfo.php" class="nav-link link-body-emphasis" >
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
 <a href="Adm_Adv.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> Add a New Advisor </h7>
  </div>
  <div class="card-body">


<?php

// Check if an error parameter is set in the URL
if (isset($_GET['error']) && $_GET['error'] == 1) {
    // Display an error message in red
    echo'<script>alert("Something goes wrong, Advisor information has not been inserted.")</script>'; 

} elseif (isset($_GET['error']) && $_GET['error'] == 0) {
 echo '<script>alert("Advisor information has been inserted successfully.")</script>';
}
?>

     
<form action="InsAdv.php" method="post" enctype="multipart/form-data">

  <div class="form-group row">
<label for="username" class="col-sm-2 col-form-label">Advisor Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" placeholder="MoSalman" required>
    </div>
  </div><br>

  <div class="form-group row">
<label for="Name" class="col-sm-2 col-form-label">Advisor Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="Name" placeholder="Mohammeb Salman" required>
    </div>
  </div><br>

<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
  <div class="form-group row">
    <label for="Password" class="col-sm-2 col-form-label">Advisor Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="Password" placeholder="Password" required>
    </div>
  </div><br>

  <div class="form-group row">
<label for="Email" class="col-sm-2 col-form-label">Advisor Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="Email" placeholder="Mosalman@ub.edu.sa" required>
    </div>
  </div> <br>

  <div class="form-group row">
<label for="Phone" class="col-sm-2 col-form-label">Advisor Mobile</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="Phone" placeholder="05xxxxxxxx" minlength="10" required>
    </div>
  </div><br>

  <div class="form-group row">
    <label for="Department" class="col-sm-2 col-form-label">Department</label>
    <div class="col-sm-10">
      <select name="Department" class="form-control" >
       
 <option selected disabled>Choose department</option>
<option  value="Computer Science & Artificial intelligence">Computer Science & Artificial intelligence</option>
<option value="Information System & Cyber Security">Information System & Cyber Security</option>

      </select>
    </div>
  </div><br>
 

 <div class="form-group row">
    <label for="Office_Number" class="col-sm-2 col-form-label">Office Number</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" name="Office_Number" placeholder="101" required>
    </div>
  </div><br>

 <div class="form-group row">
    <label for="Office_hours" class="col-sm-2 col-form-label">Office Hours</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" name="Office_hours" placeholder="Sunday 10am" required>
    </div>
  </div><br>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" style="background-color: #04AA6D; border: red;">Add Advieor </button>
    </div>
  </div>
</form>

</div>
</div>



<!-- Cards End HERE --> 


<!-- Cards start HERE -->


<div class="card  w-90 d-block" style="margin: 30px 20px 60px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> List of Advisors </h7>
  </div>
  <div class="card-body">

<table class="table">
  <thead>
    <tr>
	<th scope="col">Username</th>
      <th scope="col">Name</th>
	<th scope="col">Email</th>
<th scope="col">Mobile</th>
  <th scope="col">Department</th>
 <th scope="col">Office Number</th>
 <th scope="col">Office Hours</th>
    </tr>
  </thead>
  <tbody>

 <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr> ";
echo '<th>' . $row['username']. "</th>";
echo "<td>". $row['Name']."</td>";
echo "<td>". $row['Email']."</td>";
echo "<td>". $row['Phone']."</td>";
echo "<td>". $row['Department']."</td>";
echo "<td>". $row['Office_Number']."</td>";
echo "<td>". $row['Office_hours']."</td>";
echo "</tr>";
					
                }
            } else {
                echo "<tr><td colspan='4'>No uploaded files found.</td></tr>";
            }
			
			
            ?>







  </tbody>
</table>



</div>
</div>
</div>

<!-- Cards End HERE --> 



</main>
</body>
</html>