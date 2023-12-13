<?php

    include_once('error-handler.php');
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

    // default admin password
    $hPassword = hash("sha256","1234");
    $screens = ['cinema 1','cinema 2','cinema 3','cinema 4'];

    // establish a database connection
    $conn = mysqli_connect($host,$user,$password);


    if($conn){
        // create database if it has not yet been created
        $sql = "SHOW DATABASES WHERE `database` = '{$database}'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) < 1){
            createDatabaseAndTables($conn,$database, $hPassword);
            populateGenreTable($conn, $database);
        }
        else{
            $conn = mysqli_connect($host,$user,$password,$database);
        }
    }


    function populateGenreTable($conn, $db){
        require_once('api-handler.php');
        $genre_url = "https://api.themoviedb.org/3/genre/movie/list";
        $response = fetchData($genre_url);
        $genres = $response->{'genres'};

        foreach($genres as $genre){
            $genre_id = $genre->{'id'};
            $genre_name = $genre->{'name'};
            $sql = "INSERT INTO `{$db}`.`genre` VALUES ({$genre_id},'{$genre_name}')";
            mysqli_query($conn, $sql);
        }
    }


    function createDatabaseAndTables($conn, $db, $password){
        $multi_sql = "
            CREATE DATABASE {$db};

            CREATE TABLE `{$db}`.`user` (`user_id` int(11) NOT NULL AUTO_INCREMENT,`first_name` varchar(100) NOT NULL,`last_name` varchar(100) NOT NULL,`email` varchar(100) NOT NULL,`password` varchar(100) NOT NULL,`role` varchar(50) NOT NULL,PRIMARY KEY (`user_id`),UNIQUE KEY `email` (`email`)) ENGINE=InnoDB;

            INSERT INTO `{$db}`.`user` VALUES ('','default','admin','admin@email.com','{$password}','admin');

            CREATE TABLE `{$db}`.`movie` (`movie_id` INT NOT NULL , `movie_title` VARCHAR(100) NOT NULL , `movie_plot` VARCHAR(500) NOT NULL , `movie_duration` INT NOT NULL , `movie_poster` VARCHAR(100) NOT NULL , `movie_trailer` VARCHAR(100) NOT NULL , `movie_rating` VARCHAR(10) NOT NULL , PRIMARY KEY (`movie_id`)) ENGINE = InnoDB;

            CREATE TABLE `{$db}`.`screen` (`screen_id` INT NOT NULL , `screen_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`screen_id`)) ENGINE = InnoDB;

            CREATE TABLE `{$db}`.`genre` (`genre_id` INT NOT NULL , `genre_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`genre_id`)) ENGINE = InnoDB;

            CREATE TABLE `{$db}`.`has_genre` (`movie` int(11) NOT null,`genre` int(11) NOT NULL, KEY `movie` (`movie`),  KEY `genre` (`genre`), CONSTRAINT `has_genre_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `has_genre_fk2` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ) ENGINE=INNODB;

            CREATE TABLE `{$db}`.`is_scheduled_for` (`user` int(11) NOT null, `movie` int(11) NOT null, `screen` int(11) NOT null,`start` date, `end` date, KEY `user` (`user`), KEY `movie`(`movie`), CONSTRAINT `schedule_fk1` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`), CONSTRAINT `schedule_fk2` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`),CONSTRAINT `schedule_fk3` FOREIGN KEY (`screen`) REFERENCES `screen` (`screen_id`))ENGINE=INNODB;

        ";
        mysqli_multi_query($conn,$multi_sql);
        while(mysqli_next_result($conn));
    }
?>