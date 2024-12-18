<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "murshdy";

$conn = new mysqli($servername, $username, $password, $dbname);
   
 if (isset($_SESSION['user_id'])) {
    $session_id = $_SESSION['user_id'];

    $sql_student = "SELECT S_ID, A_ID FROM student WHERE A_ID = (SELECT A_ID FROM advisor WHERE username = '$session_id')";
    $result_student = $conn->query($sql_student);

    if ($result_student->num_rows > 0) {
       
        $row_student = $result_student->fetch_assoc();
        $student_id = $row_student['S_ID'];
		$A_id = $row_student['A_ID'];
	
		
}}
include ('Ad_Chat.php');
$chat = new Chat();
if($_POST['action'] == 'update_user_list') {
	$chatUsers = $chat->chatUsers($row_student['A_ID']);
	$data = array(
		"profileHTML" => $chatUsers,	
	);
	echo json_encode($data);	
}
if($_POST['action'] == 'insert_chat') {
	$chat->insertChat($_POST['to_user_id'], $row_student['A_ID'], $_POST['chat_message']);
}
if($_POST['action'] == 'show_chat') {
	$chat->showUserChat( $row_student['S_ID'], $_POST['to_user_id']);
}
if($_POST['action'] == 'update_user_chat') {
	$conversation = $chat->getUserChat($row_student['A_ID'], $_POST['to_user_id']);
	$data = array(
		"conversation" => $conversation			
	);
	echo json_encode($data);
}
if($_POST['action'] == 'update_unread_message') {
	$count = $chat->getUnreadMessageCount($_POST['to_user_id'], $row_student['A_ID']);
	$data = array(
		"count" => $count			
	);
	echo json_encode($data);
}
?>