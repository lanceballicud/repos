<?php

    //connection
    $mysqli = require __DIR__ . "/vs_database.php";

    mysqli_report(MYSQLI_REPORT_OFF);

    //initialize variables

    $name = "";
    $artist = "";
    $album = "";
    $genre = "";
    
    

    $errorMessage = "";
    $successMessage = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $name = $_POST["name"];
        $artist = $_POST["artist"];
        $album = $_POST["album"];
        $genre = $_POST["genre"];
       

        do{
            if(empty($name) || empty($artist) || empty($album) || empty($genre)){
                $errorMessage = "All the fields are required";
                break;
            }

            // add new song to the database.

            $sql = "INSERT INTO songs (name,artist,album,genre)
            VALUES (?, ?, ?, ?)";

            $stmt = $mysqli->stmt_init();

            if(!$stmt->prepare($sql)){
                die("SQL error: " . $mysqli->error);
            }

            $stmt -> bind_param("ssss",$name, $artist, $album, $genre);
            // binds the values to the placeholders.

            if($stmt->execute()){

                header("Location: project_songs.php");
                exit;
            }
            else{
                die($mysqli->error . " " . $mysqli->errno);
            }
            
            //------------------------------------------
            
            // ALT WAY OF INSERTING VALUES TO SQL

            // $sql = "INSERT INTO songs (name,artist,album,genre) 
            //         VALUES id ('$name','$artist','$album','$genre');

            // $result = $mysqli->query($sql);

            // if(!$result){
            // $errorMessage = " Invalid query " . $mysqli->error;
            // break;
            // }

            //-------------------------------------------

            // this changes below codes changes the values back to null
            // this way the page will output null values in input tags.

            $name = "";
            $artist = "";
            $album = "";
            $genre = "";

            $successMessage = "Song added successfully";

        } while(false);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vs_style.css">
    <title>Document</title>
</head>
<body>
    <div class="headcontainer">
        <h1> Create New Song </h1>
    </div>
    <div class="formcontainer">
        <div class="signup">
            <?php if(!empty($errorMessage)){
                echo "<em> $errorMessage ! </em>";
            }
            elseif(!empty($successMessage)){
                echo "<em> $successMessage ! </em>";
            }        
            ?>
        </div>
        <form method="post">
        <!-- action is not necessary since dito lang mapupunta yung values sa file -->
            <div class="userbox">
                <label class="text">Name</label>
                <input type="text" name="name" value="<?php echo $name;?>">
            </div>
            <div class="userbox">
                <label class="text">Artist</label>
                <input type="text" name="artist" value="<?php echo $artist;?>">
            </div>
            <div class="userbox">
                <label class="text">Album</label>
                <input type="text" name="album" value="<?php echo $album;?>">
            </div>
            <div class="userbox">
                <label class="text">Genre</label>
                <input type="text" name="genre" value="<?php echo $genre;?>">
            </div>
            <div class="buttonDiv">
                <input class="text" type="submit" name="submit" value="Submit">
            </div>
            <div class="buttonDiv1">
                <a href="project_songs.php"> Cancel </a>
            </div>
        </form>
    </div>
</body>
</html>