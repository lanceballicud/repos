<?php

if (empty($_POST["username"])){
    die("Username is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Invalid email");
}

if(strlen($_POST["password"]) < 5){
    die("Password must contain at least 5 characters");
}

if($_POST["password"]!==$_POST["confirm_pass"]){
    die("Password must match");
}

$hash = password_hash($_POST["password"],PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/vs_database.php";

mysqli_report(MYSQLI_REPORT_OFF);
//to solved not showing error descript and error code.

$sql = "INSERT INTO users (user,email,password)
        VALUES (?, ?, ?)";
        // placeholders

$stmt = $mysqli->stmt_init();
// preparer statement object by calling statement init method on mysli connection object.

if(!$stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);    
}
//check if theres an error from the sql.

$stmt -> bind_param("sss", $_POST["username"],$_POST["email"],$hash);
// bind the values to placeholder.

if($stmt->execute()){
    // execute returns true if successful and false if otherwise, we can chekc using if statement.
    // to execute the statements. We call execute method on the statement object.
    // here syntax error catches the error from duplicates
    
    //echo "Signup successful";

    header("Location: vs_signup_success.html");
    exit;
    //good practice to exit once we've sent the header

}
else{
        if($mysqli->errno == 1062){
            die("Username/ Email is already taken");
        }else{
            die($mysqli->error . " " . $mysqli->errno);
        }
        
}
?>

