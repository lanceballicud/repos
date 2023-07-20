<?php
    $id ="";
    $name = "";
    $artist = "";
    $album = "";
    $genre = "";
    $date = "";

    $errorMessage = "";
    $successMessage = "";

    $mysqli = require __DIR__ . "/vs_database.php";

  


    $id = $_GET["updateid"];

    $sql = "SELECT * FROM songs where id=$id";

    $result = $mysqli->query($sql);

    $row = mysqli_fetch_assoc($result);

    
    $name = $row["name"];
    $artist = $row["artist"];
    $album = $row["album"];
    $genre = $row["genre"];


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $artist = $_POST["artist"];
        $album = $_POST["album"];
        $genre = $_POST["genre"]; 

        date_default_timezone_set('Asia/Manila');
        // set timezone
        $date = date("Y-m-d H:i:s");

        $sql = "UPDATE songs
                SET name='$name', artist='$artist', album='$album', genre='$genre', date_modified='$date'
                WHERE id = $id";

        $result = $mysqli->query($sql);

        if(!$result){
            $errorMessage = "Invalid query" . $mysqli->error;
        }
        
        $successMessage = "Song edited successfully";

        header("Location: project_songs.php");
        exit;
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
        
        <h1> Update Song </h1>
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
        <input type="hidden" name="id" value="<?php echo $id;?>">
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
                <input class="text" type="submit" name="submit" value="Update">
            </div>
            <div class="buttonDiv1">
                <a href="project_songs.php"> Cancel </a>
            </div>
        </form>
    </div>
</body>
</html>