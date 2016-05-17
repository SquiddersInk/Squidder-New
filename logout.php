<?php 

    // Run this to connect the common code to our database. Starts the session
    require("common.php"); 
     
    // Removes the User’s data from the session 
    unset($_SESSION['user']); 
     
    // This is directing to the login page
    header("Location: login.php"); 
    die("Redirecting to: login.php");
	
?>