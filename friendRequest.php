<?php

include "database_connect.php";

$fid = $_POST["fiD"];
$uid = $_POST["uiD"];


// functionality if friend request is accepted
    if(isset($_POST["accept"])){ 
        //DELETE FROM `pendingRequest` WHERE 1
       $query = "INSERT INTO `friendship`(`user_id`, `friend_id`) VALUES ($fid,$uid)";
       $connection->query($query);
       $query = "INSERT INTO `friendship`(`user_id`, `friend_id`) VALUES ($uid,$fid)";
       $connection->query($query);   
       $query = "DELETE FROM `pendingRequest` WHERE from_id=$fid and to_id=$uid";
       $connection->query($query);
       $query = "DELETE FROM `pendingRequest` WHERE from_id=$uid and to_id=$fid";
       $connection->query($query);    
    }

// functionality if friend request is rejected remove it form pendingRequest
    if(isset($_POST["reject"])){
       $query = "DELETE FROM `pendingRequest` WHERE from_id=$fid and to_id=$uid";
       $connection->query($query);
       $query = "DELETE FROM `pendingRequest` WHERE from_id=$uid and to_id=$fid";
       $connection->query($query);
    }  

// delete if request is cancled
     if(isset($_POST["cancle"])){
         echo "heeee";
       $query = "DELETE FROM `pendingRequest` WHERE from_id=$uid and to_id=$fid";
       $connection->query($query);
    }  
?>