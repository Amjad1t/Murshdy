<!doctype html>
<html lang="en" data-bs-theme="auto">
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);
if (isset($_SESSION['user_id'])) {
   
    $username = $_SESSION['user_id']; 
    $sql_student = "SELECT * FROM student WHERE username = '$username'";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0) {
        $row_student = $result_student->fetch_assoc();
        $s_id = $row_student['S_ID'];
    }
}$_SESSION['uesr_id']=$s_id 
?>

<html lang="en" data-bs-theme="auto">

<head>

<!-- CSS files -->
<link rel="stylesheet" href="./style/css/bootstrap.css">
<link rel="stylesheet" href="./style/JS/bootstrap.JS">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<!-- Meta Infos -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Acadimic Advising system">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="./js/chat.js"></script>
<link rel="stylesheet" href="./style/style.css">
<style>
.modal-dialog {
    width: 400px;
    margin: 30px auto;	
}
</style>
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
<a href="Stu_PublicQ.php" class="nav-link link-body-emphasis">
<img src="./images/question_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Public questions
</a>
</li>



<li>
<a href="Stu_Directmessage.php" class="nav-link link-body-emphasis" style="background-color:#f3f2f5;">
<img src="./images/message_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Direct Message
</a>
</li>

<li style="margin-top:100px">
<a href="logout.php" class="nav-link link-body-emphasis">
<img src="./images/log_out_icon.png" class="bi pe-none me-2" width="16" height="16"></img>
Log out
</a>
</li>

</ul>
</div>
<!-- sidebar End HERE --> 


<!-- Cards start HERE -->
<div class="container"> 
<?php  echo 'ID: '.$_SESSION['uesr_id'] ?>        
 <?php 
    if(isset($_SESSION['user_id']) ) { ?>     
        <div class="chat">    
            <div id="frame">        
                <div id="sidepanel">
                    <div id="profile">
                    <?php
                    include ('Chat.php');
					
                    $chat = new Chat();
                    $loggedUser = $chat->getUserDetails($_SESSION['user_id']);
                    echo '<div class="wrap">';
                    $currentSession = '';
                    foreach ($loggedUser as $user) {
                        $currentSession = $user['current_session'];
                        echo  '<p>'.$user['Name'].'</p>';
                            echo '<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>';
                            echo '<div id="status-options">';
                            echo '<ul>';                           
                            echo '</ul>';
                            echo '</div>';
                            echo '<div id="expanded">';            
                            echo '<a href="logout.php">Logout</a>';
                            echo '</div>';
                    }
                    echo '</div>';
                    ?>
                    </div>
                    
                    <div id="contacts">    
                    <?php
                    echo '<ul>';
                    $chatUsers = $chat->chatUsers($_SESSION['user_id']);
                    foreach ($chatUsers as $user) {
                        
                        $activeUser = '';
                        if($user['A_ID'] == $currentSession) {
                            $activeUser = "active";
                        }
                        echo '<li id="'.$user['A_ID'].'" class="contact '.$activeUser.'" data-touserid="'.$user['A_ID'].'" data-tousername="'.$user['Name'].'">';
                        echo '<div class="wrap">';
                        
                        
                        echo '<div class="meta">';
                        echo '<p class="name">'.$user['Name'].'<span id="unread_'.$user['A_ID'].'" class="unread">'.$chat->getUnreadMessageCount($user['A_ID'], $_SESSION['user_id']).'</span></p>';
                        
                        echo '</div>';
                        echo '</div>';
                        echo '</li>'; 
                    }
                    echo '</ul>';
                    ?>
                    </div>
                    
                </div>          
                <div class="content" id="content"> 
                
                    <div class="messages" id="conversation">       
                    <?php
                    echo $chat->getUserChat($row_student['S_ID'], $currentSession);                      
                    ?>
                    </div>
                    <div class="message-input" id="replySection">                
                        <div class="message-input" id="replyContainer">
                            <div class="wrap">
                                <input type="text" class="chatMessage" id="chatMessage<?php echo $currentSession; ?>" placeholder="Write your message..." />
                                <button class="submit chatButton" id="chatButton<?php echo $currentSession; ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>   
                            </div>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <br>
        <br>
        <strong><a href="login.php"><h3>Login To Access Chat System</h3></a></strong>        
    <?php } ?>
    <br>
    <br>    
    
</div>  



<!-- Cards End HERE --> 

</main>
</body>
</html>