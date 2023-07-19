<?php

$is_invalid = false;

if($_SERVER["REQUEST_METHOD"]==="POST"){
    // the form will be sent in this script, use this syntax when a button is clicked.
    
    $mysqli = require __DIR__ . "/vs_database.php";

    $sql = sprintf("SELECT * FROM users WHERE user = '%s'", $mysqli->real_escape_string($_POST["username"]));
    // we use sprint f to insert the value from the form
    // to avoid sql injection attack, we need to escape the value from the form. real_escape_string.

    $result = $mysqli->query($sql);
    // we will return object the query command to the result variable, and passing the $sql statement variable.


    $user = $result->fetch_assoc();
    // to get the data from the object, we call the fetch_assoc() method. THis will return a method if one was found as an associative array.
    // assigned it to a variable.

    // var_dump($user);
    // to check the contents of the result. 

    if($user){
        if(password_verify($_POST["password"],$user["password"])){
            
            session_start();
            // we use session_start in order for us to use session

            session_regenerate_id();
            // we add this so avoid session fixation attack.
            // generats new session id and updates the current one.

            $_SESSION["user_id"] = $user["id"];
            // we declared session user id with value of user["id"] fetched from the database.
            // we passed the value of the id key to the session user id.

            header("Location: vs_index.php");
            exit;

        }
    }

    // to get the data from the result object, we call the fetch_assoct()
    // this wil lreturn a record if one was found as an associative array.

    $is_invalid = true;
    // the condition above will be skipped if the user enters a wrong username or incorrect password.
    // then this variable will become true, kung nag true na yung variable na to, madidisplay yung condition sa html which is yung login failed.

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="vs_style.css"> 
</head>
<body>
    <div class="headcontainer">
        <h1 class="text">Easy Bay<h1>
    </div>
    <div class="formcontainer">
        <div class="signup">
            <h1> Login </h1>
        </div>
        <form method="post">
            <?php if($is_invalid): ?>
                <div class="login">
                <em>Login failed</em>
                </div>
            <?php endif; ?>
            <div class="userbox">
                <label class="text">Username</label>
                <input type="text" name="username" class="username" value="<?= $haha=htmlspecialchars($_POST["username"] ?? "")?>" placeholder="Enter your username">
            </div>
            <div class="userbox">
                <label class="text">Password</label>
                <input type="password" name="password" class="password" placeholder="Enter your password">
            </div>
            <div class="buttonDiv">
                <button class="text" font-size="30px">Login</button>
            </div>
            <div class="buttonDiv1">
                <a href="vs_signup.html" class="btn1 text">I don't have an account</a>
            </div>
        </form>
    </div>
</body>
</html>