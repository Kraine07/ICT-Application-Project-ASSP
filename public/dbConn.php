<?php

require_once('message-display.php');
    require_once('redirect.php');

    //turn off mysqli error reporting
    mysqli_report(MYSQLI_REPORT_OFF);


    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "backyard_cinema_v02";


    // tables
    $movie_table = 'movie';
    $user_table = 'user';
    $genre_table = 'genre';
    $screen_table = 'screen';
    $cast_table = 'cast';
    $schedule_table = "schedule";
    $has_genre_table = 'has_genre';




    // establish a database connection
    $conn = mysqli_connect($host,$user,$password);
    if(!$conn){
        // show 404 page to patron
        if($_SESSION['patron-view']){
            redirect('404.php');
        }else{
            showErrorMessage('Error connecting to database server. Please try again or contact technical support.', 'index');
        }
    }
    else{
        // check if database needs to be initialized
        if(!isset($_SESSION['db-setup']) || $_SESSION['db-setup'] == 1){
            $sql = "SHOW DATABASES WHERE `database` = '{$database}'";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result) < 1){
                // load setup form
                if(!$_SESSION['patron-view']){
                    $_SESSION['db-setup'] = 0;
                    redirect('init.php');
                }
                else{
                    redirect('404.php');
                }
            }
            else{
                $_SESSION['db-setup'] = 1;
            }
        }
    }





?>