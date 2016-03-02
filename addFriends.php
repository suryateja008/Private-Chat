<?php
// imports data base file
include "database_connect.php";

$fid = $_POST["fiD"];
$uid = $_POST["uiD"];

// insert into table for pendingRequests
$query = "INSERT INTO `webChat`.`pendingRequest` (`from_id`, `to_id`) VALUES ('$uid', '$fid')";
$result = $connection->query($query);

?>