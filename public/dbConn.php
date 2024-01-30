<?php

require_once('message-display.php');
    require_once('redirect.php');

    //turn off mysqli error reporting
    mysqli_report(MYSQLI_REPORT_OFF);


    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "backyard_cinema_v01";


    // tables
    $movie_table = 'movie';
    $user_table = 'user';
    $genre_table = 'genre';
    $screen_table = 'screen';
    $schedule_table = "schedule";
    $has_genre_table = 'has_genre';




    // establish a database connection
    $conn = mysqli_connect($host,$user,$password);
    if(!$conn){
        showErrorMessage('Error connecting to database server. Please try again or contact technical support.', 'index');
    }




?>