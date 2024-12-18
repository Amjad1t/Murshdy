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
//$sql = "SELECT  Adm_ID, Adm_Name, password, Adm_Email, Adm_Mobile, AdmOffice_Number,AdmOffice_Phone, username FROM Admin WHERE username = '$username'";
$sql = "SELECT s.S_ID, s.Name, s.password, s.Major, s.Email, s.Phone,s.Plan, s.username, a.Name as AdvisorName
        FROM student s
        LEFT JOIN advisor a ON s.A_ID = a.A_ID";



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
<a href="Adm_Stu.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> Add a New Student </h7>
  </div>
  <div class="card-body"> 
<?php
// Check if an error parameter is set in the URL
if (isset($_GET['error']) && $_GET['error'] == 1) {
    // Display an error message in red
    echo'<script>alert("Something goes wrong, Student information has not been inserted.")</script>'; 

} elseif (isset($_GET['error']) && $_GET['error'] == 0) {
 echo '<script>alert("Student information has been inserted successfully.")</script>';
}
?><form action="InsStu.php" method="post" enctype="multipart/form-data">

  <div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label">Student ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name="username" placeholder="445802020">
    </div>
  </div><br>

  <div class="form-group row">
    <label for="Name" class="col-sm-2 col-form-label">Student Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Name" name="Name" placeholder="Mohammed Salman">
    </div>
  </div><br>

  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Student Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="XXXXXXXX">
    </div>
  </div><br>

  <div class="form-group row">
    <label for="Email" class="col-sm-2 col-form-label">Student Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="Email" name="Email" placeholder="445802020@stu.ub.edu.sa">
    </div>
  </div><br>

  <div class="form-group row">
    <label for="Phone" class="col-sm-2 col-form-label">Student Mobile</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="Phone" name="Phone" placeholder="05xxxxxxxx">
    </div>
  </div><br>
 <script>
// JavaScript function to update plan image based on selected major
function updatePlan() {
    var majorSelect = document.getElementById("Major");
    var planImage = document.getElementById("plan");

    // Get the selected major
    var selectedMajor = majorSelect.value;

    // Define a mapping of majors to plan image paths
    var planImages = {
        "Artificial intelligence": "./images/AI.jpg",
        "Computer Science": "./images/CS.jpg",
        "Cyber Security": "./images/CySec.jpg",
        "Information System": "./images/IS.jpg"
    };

    // Set the plan image based on the selected major
    if (selectedMajor in planImages) {
        planImage.src = planImages[selectedMajor];
    } else {
        planImage.src = ""; // Clear the image if no match found
    }
}
</script>
<div class="form-group row">
    <label for="Major" class="col-sm-2 col-form-label">Major</label>
    <div class="col-sm-10">
        <select id="Major" class="form-control" name="Major" onchange="updatePlan()">
            <option selected disabled>Choose major</option>
            <option value="Artificial intelligence">Artificial intelligence</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Cyber Security">Cyber Security</option>
            <option value="Information System">Information System</option>
        </select>
    </div>
</div>
<br>
<div class="form-group row">
    <label for="A_ID" class="col-sm-2 col-form-label">Academic Advisor</label>
    <div class="col-sm-10">
        <select id="A_ID" class="form-control" name="A_ID">
            <option selected disabled>Choose advisor</option>
            <?php
            // Fetch advisors' data from the advisor table
            $advisor_query = "SELECT A_ID, Name FROM advisor";
            $advisor_result = $conn->query($advisor_query);
            // Check if there are advisors in the database
            if ($advisor_result->num_rows > 0) {
                // Loop through each advisor and create an option for the select element
                while ($advisor_row = $advisor_result->fetch_assoc()) {
                    echo '<option value="' . $advisor_row['A_ID'] . '">' . $advisor_row['Name'] . '</option>';
                }
            } else {
                echo '<option disabled>No advisors available</option>';
            }
            ?>
        </select>
    </div>
</div><br>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" style="background-color: #04AA6D; border: red;">Add Student</button>
    </div>
  </div>
</form>
</div>
</div>
<!-- Cards End HERE --> 


<!-- Cards start HERE -->
<div class="card  w-90 d-block" style="margin: 30px 20px 60px 20px ; " >
  <div class="card-header" style="font-weight: 500;">
    <h7> List of Students </h7>
  </div>
  <div class="card-body">

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Password</th>
      <th scope="col">Email</th>
 <th scope="col">Mobile</th>
 <th scope="col">Major</th>
 <th scope="col">Plan</th>
 <th scope="col">Advisor</th>
    </tr>
  </thead>
  <tbody>
		   
		 <?php
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<tr> ";
		echo '<th>' . $row['username']. "</th>";
		echo "<td>". $row['Name']."</td>";
		echo "<td>". $row['password']."</td>";
		echo "<td>". $row['Email']."</td>";
		echo "<td>". $row['Phone']."</td>";
		echo "<td>". $row['Major']."</td>";
		echo "<td>";
		echo '<a href="' . $row['Plan'] . '" target="_blank">View Plan</a>';
		echo "</td>";
		echo "<td>". $row['AdvisorName']."</td>";
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