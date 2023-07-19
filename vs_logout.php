<?php

session_start();
// we always tart a session to use session destroy.

session_destroy();
// we destroyed the session variable so that the if statement condition na isset ay magiging false, so ididisplay ng script
// is yung login and signout

header("Location: vs_index.php");
exit;

//we dont need technically an exit as is the last line of the script
//good practice to always include after sending a location header.