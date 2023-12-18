<?php

    require_once('error-handler.php');
    require_once('redirect.php');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // enable mysql error reporting


    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "backyard_cinema";


    // tables
    $movie_table = 'movie';
    $user_table = 'user';
    $genre_table = 'genre';
    $screen_table = 'screen';
    $has_genre_table = 'has_genre';
    $is_scheduled_for_table = "is_scheduled_for";




    // establish a database connection
    $conn = mysqli_connect($host,$user,$password);


    


?>