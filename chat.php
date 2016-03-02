<?php

// gets user and friend id to chat 
if(isset($_GET["fid"]) && isset($_GET["uid"]) && isset($_GET["uname"])){
   $friendID = $_GET["fid"];
   $userID = $_GET["uid"]; 
   $username = $_GET["uname"];

}

?>


<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/chat_display.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="js/chat.js"></script> 
      <script type="text/javascript">
      
            $("document").ready(function(){
               getMsg(<?php echo $userID.",".$friendID.",'none'" ?>);
            });
      </script>
    <title>Chatting With <?php echo $username ?></title>
  </head>
<body>
  <div id="chatDisplay">
    <h1>Chatting With <?php echo $username?></h1>
     <div id="showMessages">
     
     </div>
      <input id="chatInput" type="text" name="chatmsg" onkeydown="if (event.keyCode == 13) document.getElementById('sendButton').click()" /> 
      <button  onclick="sendMsg(<?php echo $userID.','.$friendID.','.$userID ?>)" id="sendButton">Send</button>
  </div>       
</body>
</html>