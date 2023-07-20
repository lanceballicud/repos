<?php

    $mysqli = require __DIR__ . "/vs_database.php";



    if(isset($_GET["deleteid"])){
        $id = $_GET["deleteid"];

        $sql = "DELETE FROM songs WHERE id = $id";
        
        $result = $mysqli->query($sql);

        if($result){
            echo "Deleted successfully";
        }
        else{
            die(mysqli_error($result));
        }
        
    }

    header("Location: project_songs.php");
    exit;

?>