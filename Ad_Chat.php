<?php
class Chat{
    private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "murshdy";      
    private $chatTable = 'chat';
    private $chatUsersTable = 'advisor';
    private $recieverTable = 'student';
    private $dbConnect = false;
    
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
    
    private function getData($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $data= array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[]=$row;            
        }
        return $data;
    }
    
    private function getNumRows($sqlQuery) {
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        if(!$result){
            die('Error in query: '. mysqli_error());
        }
        $numRows = mysqli_num_rows($result);
        return $numRows;
    }
    
    public function loginUsers($username, $password){
        $sqlQuery = "
            SELECT A_ID, username 
            FROM ".$this->chatUsersTable." 
            WHERE username='".$username."' AND Password='".$password."'";
        
        return $this->getData($sqlQuery);
    }
    
    public function chatUsers($userid){
        $sqlQuery = "
            SELECT * FROM ".$this->recieverTable." 
            WHERE A_ID = '$userid'";
        
        return $this->getData($sqlQuery);
    }
    
    public function getUserDetails($userid){
        $sqlQuery = "
            SELECT * FROM ".$this->chatUsersTable." 
            WHERE A_ID = '$userid'";
        
        return $this->getData($sqlQuery);
    }
    
   public function insertChat($reciever_userid, $user_id, $chat_message) {       
    $sqlInsert = "
        INSERT INTO ".$this->chatTable." 
        (reciever_userid, sender_userid, message, status) 
        VALUES ('".$reciever_userid."', '".$user_id."', '".$chat_message."', '1')";
    $result = mysqli_query($this->dbConnect, $sqlInsert);
    if(!$result){
        return ('Error in query: '. mysqli_error());
    } else {
        $conversation = $this->getUserChat($user_id, $reciever_userid);
        $data = array(
            "conversation" => $conversation            
        );
        echo json_encode($data);    
    }
}
public function getUserChat($from_user_id, $to_user_id) {            
        $sqlQuery = "
            SELECT * FROM ".$this->chatTable." 
            WHERE (sender_userid = '".$from_user_id."' 
            AND reciever_userid = '".$to_user_id."') 
            OR (sender_userid = '".$to_user_id."' 
            AND reciever_userid = '".$from_user_id."') 
            ORDER BY timestamp ASC";
        
        $userChat = $this->getData($sqlQuery);    
        $conversation = '<ul>';
        
        foreach($userChat as $chat){
            $user_name = '';
            
            if($chat["sender_userid"] == $from_user_id) {
                $conversation .= '<li class="sent">';
            } else {
                $conversation .= '<li class="replies">';
            }            
            
            $conversation .= '<p>'.$chat["message"].'</p>';            
            $conversation .= '</li>';
        }        
        
        $conversation .= '</ul>';
        return $conversation;
    }
    public function showUserChat($from_user_id, $to_user_id) {        
        $userDetails = $this->getUserDetails($to_user_id);
        $userSection = '';
        
        foreach ($userDetails as $user) {
            $userSection = '<p>'.$user['username'].'</p>';
        }        
        
        // get user conversation
        $conversation = $this->getUserChat($from_user_id, $to_user_id);    
        
        // update chat user read status        
        $sqlUpdate = "
            UPDATE ".$this->chatTable." 
            SET status = '0' 
            WHERE sender_userid = '".$to_user_id."' AND reciever_userid = '".$from_user_id."' AND status = '1'";
        
        mysqli_query($this->dbConnect, $sqlUpdate);        
        
        // update users current chat session
        $sqlUserUpdate = "
            UPDATE ".$this->chatUsersTable." 
            SET current_session = '".$to_user_id."' 
            WHERE A_ID = '".$from_user_id."'";
        
        mysqli_query($this->dbConnect, $sqlUserUpdate);        
        
        $data = array(
            "userSection" => $userSection,
            "conversation" => $conversation            
        );
        
        echo json_encode($data);        
    }
    
    public function getUnreadMessageCount($senderUserid, $recieverUserid) {
        $sqlQuery = "
            SELECT * FROM ".$this->chatTable."  
            WHERE sender_userid = '$senderUserid' AND reciever_userid = '$recieverUserid' AND status = '1'";
        
        $numRows = $this->getNumRows($sqlQuery);
        $output = '';
        
        if($numRows > 0){
            $output = $numRows;
        }
        
        return $output;
    }
}
?>
