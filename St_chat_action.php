<?php
session_start();
include ('St_Chat.php');
$chat = new StudentChat();
if($_POST['action'] == 'update_user_list') {
	$chatUsers = $chat->chatUsers($_SESSION['user_id']);
	$data = array(
		"profileHTML" => $chatUsers,	
	);
	echo json_encode($data);	
}
if($_POST['action'] == 'insert_chat') {
	$chat->insertChat($_POST['to_user_id'], $_SESSION['user_id'], $_POST['chat_message']);
}
if($_POST['action'] == 'show_chat') {
	$chat->showUserChat($_SESSION['userid'], $_POST['to_user_id']);
}
if($_POST['action'] == 'update_user_chat') {
	$conversation = $chat->getUserChat($_SESSION['user_id'], $_POST['to_user_id']);
	$data = array(
		"conversation" => $conversation			
	);
	echo json_encode($data);
}
if($_POST['action'] == 'update_unread_message') {
	$count = $chat->getUnreadMessageCount($_POST['to_user_id'], $_SESSION['user_id']);
	$data = array(
		"count" => $count			
	);
	echo json_encode($data);
}


?>