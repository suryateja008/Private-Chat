<?php


include 'database_connect.php';

// if user clicks the logout button then cookie is deleted and
//database is updated as user loged out so that he can access account from else where
if(isset($_POST["logout"])){
    
 $updateQuery = "UPDATE `users` SET `logon` = '0' WHERE `users`.`id` = ".unserialize($_COOKIE["user_info"])["id"];
 $connection->query($updateQuery);
 setcookie("user_info", "", time() - 3600,"/");
 header( 'Location: http://localhost:8888/webChat/index.php'); 
    
}
?>

<!DOCTYPE html>
  <html>
    <head>
      <title>Chat Page</title> 
      <link rel="stylesheet" type="text/css" href="css/login_css.css" />
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       <script src="js/login.js"></script> 
    </head>
    <body>
        
        <?php
        // if error stop
       if(count($_COOKIE) > 0) {
        
           if(isset($_COOKIE["user_error"])){
                echo '<div id="login_fail">'.$_COOKIE["user_error"];
               echo '<br /><a href="http://localhost:8888/webChat">Back to Login Page</a></div>';
               exit(); 
           }
            
       }
              
        ?>
      
        <div id="friendsList">
<!--            select users.id,users.username from users where !(id = 1) and id not in (select friendship.friend_id from friendship where friendship.user_id = 1)-->
            <?php

                     // if successful doo all the display work 
                    if(isset($_COOKIE["user_info"])){    
                    echo "<div id='user_welcome'>Welcome ".unserialize($_COOKIE["user_info"])["username"]."</div>";
                        
                    // query for friends    
                    $friendsQuery = "select users.id,users.username from users where id in (select friendship.friend_id from friendship where friendship.user_id =".unserialize($_COOKIE["user_info"])["id"].")";
                    $result = $connection->query($friendsQuery);
                    $userID = unserialize($_COOKIE["user_info"])["id"];
                        
                        
                        // create table of friends to select
                         echo "<div id='already_friends'>";
                         if($result->num_rows > 0){
                             echo "<table border='0' cellspacing='1' cellpadding='15'>";
                             echo "<caption>Friends List</caption>";
                             while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row["username"]."</td><td><button onclick=chatUser('".$row["id"]."','".$userID."','".$row["username"]."') id='smallBut'>Chat</button></td></tr>";
                           }
                            echo "</table>";
                         }
                        echo "<button id='justBut' onclick=visible()>Add More Friends</button>";
                         echo "<button id='justBut' onclick=pendingReq()>Pending Request's</button>";
                        echo "</div>";
                        
                     
                        
                        $friendRequest = "SELECT `id`, `username` FROM `users` WHERE id in (SELECT `from_id` FROM `pendingRequest` WHERE to_id=$userID)";
                    
                        $friendRequestresult = $connection->query($friendRequest);
                        
                        //accept friend 
                         echo "<div id='friendRequest'>";
                         if($friendRequestresult->num_rows > 0){
                             echo "<table border='0' cellspacing='1' cellpadding='15'>";
                             echo "<caption>Friends Request</caption>";
                             while($rows = $friendRequestresult->fetch_assoc()){
                                echo "<tr><td>".$rows["username"]."</td><td><button onclick=acceptFriend('".$rows["id"]."','".$userID."'".")>Accept</button></td><td><button onclick=rejectFriend('".$rows["id"]."','".$userID."'".")>Decline</button></td></tr>";
                           }
                            echo "</table>";
                         }
                        
                        echo "</div>";
                        
                        
                        //end of test
                        
                        // gather friends to add list
                        $friendAdd = "select users.id,users.username from users where !(id = $userID) and id not in (select friendship.friend_id from friendship where friendship.user_id = $userID) and id not in (select to_id from pendingRequest where from_id=$userID) and id not in (select from_id from pendingRequest where to_id= $userID)";
                        $nonFriendresult = $connection->query($friendAdd);
                        
                        
                        echo "<div id='add_friends'>";
                        // create table to add friends
                        if($nonFriendresult->num_rows > 0){
                             
                             echo "<table border='0' cellspacing='1' cellpadding='15' >";
                             echo "<caption>Friends to Add</caption>";
                             while($row = $nonFriendresult->fetch_assoc()){
                                echo "<tr><td>".$row["username"]."</td><td><button onclick=addUser('".$row["id"]."','".$userID."'".") id='smallBut' >Add</button></td></tr>";
                           }
                            echo "</table>";
                         }
                        echo "</div>";
                        
                        
                        // show the users pending friend requests
                        $friendsPendingRequests = "SELECT `id`, `username` FROM `users` WHERE id in (SELECT  `to_id` FROM `pendingRequest` WHERE from_id = $userID)";
                        $pendingResult= $connection->query($friendsPendingRequests);
                        echo "<div id='pending_requests'>";
                        // create table to add friends
                        if($pendingResult->num_rows > 0){
                             
                             echo "<table border='0' cellspacing='1' cellpadding='15' >";
                             echo "<caption>Pending Request</caption>";
                             while($row = $pendingResult->fetch_assoc()){
                                echo "<tr><td>".$row["username"]."</td><td><button onclick=cancleReq('".$row["id"]."','".$userID."'".") id='smallBut'>Cancle</button></td></tr>";
                           }
                            echo "</table>";
                         }
                        echo "</div>";
                      
                    
           }else{
                    exit();
                    }



           ?>
        
        </div>
        
                        <div id="logout_button_div">
                             <form action="login.php" method="post">
                                     <input type="submit" value="LogOut" id="logout_button"  name="logout" />
                             </form>
                        </div>
        
        
    
    </body>
  


  </html>