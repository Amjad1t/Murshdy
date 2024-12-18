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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    // Retrieve advisor ID
    $session_username = $_SESSION['user_id'];
    $sql_advisor_info = "SELECT A_ID FROM advisor WHERE username = '$session_username'";
    $result_advisor_info = $conn->query($sql_advisor_info);

    if ($result_advisor_info->num_rows > 0) {
        $row_advisor_info = $result_advisor_info->fetch_assoc();
        $advisor_id = $row_advisor_info['A_ID'];

        if (isset($_GET['id'])) {
            // Retrieve parameters from URL
            $student_id = $_GET['id'];
            $message = $_POST['message'];
            try {
              // Perform insert query execution
              $sql = "INSERT INTO notes (A_ID, S_ID, Note) VALUES ('$advisor_id', '$student_id', '$message')";
              $conn->query($sql);
              echo "<script>alert('Note added successfully');</script>";
          } catch (Exception $e) {
              echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
          }
    }}
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
<img src="./images/logo-white.png" width="200"> </>
</a>
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
<div class="card  w-90 d-block" style="margin: 60px 20px 0px 20px ; height : 500px;" >
  <div class="card-header" style="font-weight: 500;">
    <h7>Submit a new note </h7>

  </div>
  
<div class="card-body" align="center">
<p class="card-text" align="left">   </p>
 <form method="post" enctype="multipart/form-data">
<input type="hidden" name="S_ID" id="S_ID" value="<?php $_SESSION['user_id']; ?>">

  <div class="form-group row">
<label id="message" for="name" class="col-sm-2 col-form-label">Your Notes: </label>
    <div class="col-sm-10">


      <textarea rows="7" class="form-control" name="message" id="message" placeholder="Enter your question" required> </textarea>
    </div>
  </div><br>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="Send_Message" value="Send_Message" class="btn btn-primary" style="background-color: #04AA6D; border: red;">Send Note </button>
    </div>
  </div>
</form>
    </div>
	</div>
   




<div class="card  w-90 d-block" style="margin: 20px; height : 500px;" >

  <div class="card-header" style="font-weight: 500;">
    <h7> Notes list </h7>
  </div>
  <div class="card-body">
   
<p class="card-text">  </p><hr>
  <table>
                        <thead>
                            <tr>
                                <th>Advisor Name</th>
                                <th>Advisor Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetching notes for the student
                            $student_id = $_GET['id'];
                            $query = "SELECT advisor.Name AS ad_name, notes.Note
                                      FROM notes
                                      JOIN advisor ON notes.A_ID = advisor.A_ID
                                      WHERE notes.S_ID = $student_id";
                            $result = $conn->query($query); 
                            if ($result->num_rows > 0) { 
                                while($row = $result->fetch_assoc()) { 
                                    echo "<tr>";
                                    echo "<td>" . $row['ad_name'] . "</td>";
                                    echo "<td>" . $row['Note'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No notes found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
</div>
</div>


<!-- Cards End HERE --> 

<!-- Cards start HERE -->


</main>
<?php

if (isset($_GET['error'])) {
  if ($_GET['error'] == 0) {
      echo "<script>alert('Status updated successfully');</script>";
  } elseif ($_GET['error'] == 1) {
      echo "<script>alert('Something went wrong, Status not updated.');</script>";
  }
}
?>
</body>
</html>