<?php
    mysqli_report(MYSQLI_REPORT_OFF); // disable error reports

    include_once('error-handler.php');
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "backyard-cinema";

    // establish a database connection
    $conn = mysqli_connect($host,$user,$password,$database);
    // $conn = mysqli_connect($host,$user,$password,$database) or die("Database connection failed: ".mysqli_connect_error());


?>