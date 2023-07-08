<?php

    //connection for mysql.

    $server = "localhost";
    $user = "root";
    $password = "";
    $name = "registrationdb";

    $conn = "";

    try{
        $conn = mysqli_connect($server,
                               $user,
                               $password,
                               $name );
    }
    catch(mysqli_sql_exception){
        echo "Could not connect";
    }





?>