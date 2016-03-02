<?php

// redirects if user is already loged in
if(isset($_COOKIE["user_info"])){
header( 'Location: http://localhost:8888/webChat/login.php');
}

// Get the username andd password of the user from login page
if(isset($_POST['username']) && isset($_POST['password']) ){
    
$username = $_POST['username'];
$password = $_POST['password'];


include 'database_connect.php';

// check if connection exists
if($connection->connect_error){
   //echo "Error in connection database";
}else{
   
    
$query = "select * from users where username='".$username."' and password ='".$password."' and logon=0";
$result = $connection->query($query);

    // get result and sets cookie if user is valid or invalid
  if($result->num_rows > 0){
      setcookie("user_error", "", time() - 3600,"/");
      $row = $result->fetch_assoc();
      $updateQuery = "UPDATE `users` SET `logon` = '1' WHERE `users`.`id` = ".$row["id"];
      $connection->query($updateQuery);
      setcookie("user_info",serialize($row), time() + (3600), "/");
      header( 'Location: http://localhost:8888/webChat/login.php');
  }else{
      setcookie("user_error", "User Does't Exists Or Already LogedIn", time() + (3600), "/");
      header( 'Location: http://localhost:8888/webChat/login.php');
  }
    
}


    
}
?>

<!DOCTYPE html>
<html>
  <head>
     <title>LogIn Page</title>  
       <link rel="stylesheet" type="text/css" href="css/index_css.css" />
  </head>
  <body>
      
      <div id="loginSection">
          <h1>Web Chat!!!</h1>
          <form method="post" action="index.php">
              <span>Enter UserName :</span>
                    <input type="text" name="username" /> <br />  <br />
            
              <span>Enter Password :</span>
                    <input type="password" name="password"  /><br />  <br />
                    
              
             <input type="submit" value="LogOn" id="butt"/>
          </form>
       
      
      </div>
      
  </body>
</html>