<?php

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "db_login";

$mysqli = new mysqli($db_server,$db_username,$db_password,$db_name);

if($mysqli->connect_errno){
    //connect_errno dispaly error from the most recent connection attempt.
    die("Connection error" . $mysqli->connect_error);
        //connect_error displays the description ng error.
}

return $mysqli;