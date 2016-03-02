<?php

include 'database_connect.php';

// check database every second to get new update from the chat History from two users and updates it
// checking is done based on time stamp

if(isset($_POST["message"]) && isset($_POST["uID"]) && isset($_POST["fID"]) && isset($_POST["sendID"])){

$msg = $_POST["message"];
$uID = $_POST["uID"];
$fID = $_POST["fID"];
$sendID = $_POST["sendID"];
    
    // check if connection exists
if($connection->connect_error){
   //echo "Error in connection database";
}else{
    
$query = "INSERT INTO `webChat`.`chatLog` (`userID`, `friendID`, `sendMsgID`, `message`, `timeStamp`) VALUES ('$uID', '$fID', '$sendID', '$msg', CURRENT_TIMESTAMP)";
   // echo $query;
$result = $connection->query($query);
}

}  

if(isset($_POST["u"]) && isset($_POST["f"]) && isset($_POST["get"])){
$uid = $_POST["u"];
$fid = $_POST["f"];
$tstamp = $_POST["get"];
    
if($tstamp=="none"){    
$queryGET = "SELECT sendMsgID,message,timeStamp  FROM chatLog WHERE userID in ($uid,$fid) and friendID in ($uid,$fid) order by timestamp";
}else{
$queryGET = "SELECT sendMsgID,message,timeStamp  FROM chatLog WHERE userID in ($uid,$fid) and friendID in ($uid,$fid) and timestamp > '$tstamp' order by timestamp";
}
$lasttimestamp;
$resultSHOW = $connection->query($queryGET);
    
        if($resultSHOW->num_rows > 0){
             while($row = $resultSHOW->fetch_assoc()){
                 $mess = $row['message'];
                 $timeS = "(<span class='dataTime'>".$row['timeStamp']."</span>)"; 
                 
                 if($row['sendMsgID']==$uid){
                 echo "<div class='showLeft'>$timeS You: $mess</div><br /><br />";
                 }else{
                 echo "<div class='showRight'>$timeS Friend: $mess</div><br /><br />";
                 }
               $lasttimestamp = $row['timeStamp'];   
              }
            echo "|".$lasttimestamp;
        }
}
                    
?>