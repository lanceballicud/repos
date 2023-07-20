


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="vs_style.css">
    
</head>
<body>
    <div class="headcontainer">
        <h1 class="text">Welcome to your songs</h1>
    </div>

    <a class="btn123 text"  href="project_create.php" role="button"> Insert New Song</a>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Genre</th>
                <th>Date Added</th>
                <th>Date Modified</th>
            </tr>
        </thead>
        <tbody>

        <?php

            //data base connection
            $mysqli = require __DIR__ . "/vs_database.php";

            // read all rows from the database using query
            $sql = "SELECT * FROM songs";
            $result = $mysqli->query($sql);

            //check error
            if(!$result){
                die("Invalid query: " . $mysqli->error);
            }

            //read data of each row

            while($row = $result->fetch_assoc()){
                 echo "
                 <tr>
                    <td>$row[name]</td>
                    <td>$row[artist]</td>
                    <td>$row[album]</td>
                    <td>$row[genre]</td>
                    <td>$row[date_added]</td>
                    <td>$row[date_modified]</td>
                    <td>
                        <a class='btn125' href='project_edit.php?updateid=$row[id]'> Edit </a>
                        <a class='btn124' onclick='checker()' href='project_delete.php?deleteid=$row[id]'> Delete </a>            
                    </td>
                </tr>
                 ";
            }   
            // I added deleteid name so that I can get the value of the id.
        ?>
            
        </tbody>
    </table>
    <script>
        function checker(){
            var result = confirm('Are you sure?');
            if(result == false){
                event.preventDefault();x    
            }
        }
    </script>
</body>
</html>