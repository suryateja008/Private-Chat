<?php

// variables for the connection to database
$mysql_username = "root";
$mysql_password ="root";
$database = "webChat";


// creating connection to mysql
$connection = new mysqli("localhost",$mysql_username,$mysql_password,$database);

?>