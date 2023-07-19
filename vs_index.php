<?php

    session_start();

    // print_r($_SESSION);

    if(isset($_SESSION["user_id"])){

        $mysqli = require __DIR__ . "/vs_database.php";

        $sql = "SELECT * FROM users 
                WHERE id = {$_SESSION["user_id"]}";

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="BALLICUD_FINALS.css">
    <link rel="stylesheet" href="vs_style.css">
    <title>Easy Bay</title>
</head>
<body>

    <!-- <h1>Home</h1> -->

    <?php  if(isset($user)):?>

        <div class="main1">
            <div class="img1">
                <img src="leaf.png">      
            </div>
            <h1 class="Bay"> Easy Bay </h1>
            <input type="text" class="textbox1">
            <p class="ab"> Hello, <?= htmlspecialchars($user["user"])?> !</p>
            <a class="ab" href="vs_logout.php">Logout</a>
            <img class="img2" src="cart-dark.png">  
            <div class="container">
                <a href="" class="abs">Aeonium</a>
                <a href="" class="abs">Andormischus</a>
                <a href="" class="abs">Agave</a>
                <a href="" class="abs">Anacampseros</a>
                <a href="" class="abs">Aristaloe</a>
                <a href="" class="abs">More...</a>
            </div>
            <hr>
            <h2 class="Bay2">Your Source for Serious Succulent Specialties</h2>
            <div class="container2">
                <div class="greenbox"><h3>Discover succ-
                    ulent varieties 
                    one pot or rock 
                    at a time! Discover 
                    <img class="arrow" width=50px height=50px src="arrow-light.png"> 
            
                    </h3>
                </div>
                <img class="img3" src="succulents-1.jpg">

                <div class="container3">
                    <div class="container31">
                        <img width=435px height=150px src="echeveria-s.jpg">
                    </div>
                    
                    <h3 class="a2">Soothing aloe</h3>
                </div>
            </div>

            <div class="containerpix">
                <img class="images1" src="aeonium-s.jpg">
                <img class="images1" src="aloe-m.jpg">
                <img class="images1" src="cactus-s.jpg">
                <img class="images1" src="echeveria-s.jpg">
                <img class="images1" src="sedum-s.jpg">
                <img class="images1" src="sempervivum-s.jpg">
            
            
            </div>

            <div class="containernames">
                <h5 class="plantnames"> Aeonium </h5>
                <h5 class="plantnames"> Aloe </h5>
                <h5 class="plantnames"> Cactus </h5>
                <h5 class="plantnames"> Echeveria </h5>
                <h5 class="plantnames"> Sedum </h5>
                <h5 class="plantnames"> Sempervivum </h5>
            </div>
        </div>  
        <!-- if the user succesfully logged in with correct passwords
             variable $_SESSION["user_id"] will be set as the id will be declared to the variable. 
             if not then else below will be displayed in the html.-->
        <!-- I changed the isset to $user because we have the data in the user from the database. So we will check if this is set. -->
    
        
        <!-- <p> Hello <?= htmlspecialchars($user["user"])?> </p> -->
        <!-- if untrusted content when getting value from database we use htmlspecialchars() -->
        
        <!-- <p><a href="vs_logout.php">Logout</a></p> -->
        

    <?php else: ?>
        <div class="headcontainer">
            <h1 class="text">Easy Bay<h1>
        </div>
        <div class="signlog">
            <div>
                <a href="vs_login.php" class="btn12">Login</a>
            </div>
            <div>
                <a href="vs_signup.html" class="btn12">Signup</a>
            </div>
        </div>

    <?php endif; ?>
    
</body>
</html>