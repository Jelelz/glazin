<?php 
    //DATABASE MAIN CONNECT

    // Enable us to use Headers
    ob_start();

    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }

    $hostname = "localhost";
    $username = "jelel";
    $password = "JelelKimokiy@2001";
    $dbname = "registration";
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")

    

?>