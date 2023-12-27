
<?php

if(!isset($_SESSION)){
    session_start();
}

require_once('./partials/head.php');
require_once('dbConn.php');
require_once('redirect.php');
require_once('error-handler.php');


if($_SESSION['db-setup'] == 1){
    redirect('index.php');
}

// when setup form is posted
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $_SESSION['first-name'] = trim($_POST['f-name']);
    $_SESSION['last-name'] = trim($_POST['l-name']);
    $_SESSION['email']= trim($_POST['email']);
    $_SESSION['password'] = trim($_POST['password']);
    $_SESSION['c-password'] = trim($_POST['c-password']);

    $_SESSION['screen-1'] = trim($_POST['screen-1']);
    $_SESSION['screen-2'] = trim($_POST['screen-2']);
    $_SESSION['screen-3'] = trim($_POST['screen-3']);
    $_SESSION['screen-4'] = trim($_POST['screen-4']);

    if($_SESSION['password'] == $_SESSION['c-password']){
        $hPassword = hash("sha256",$_SESSION['password']);

        $admin_user = [1001,
            $_SESSION['first-name'],
            $_SESSION['last-name'],
            $_SESSION['email'],
            $hPassword,
            'admin'
        ];

        $screens = [
            $_SESSION['screen-1'],
            $_SESSION['screen-2'],
            $_SESSION['screen-3'],
            $_SESSION['screen-4'],
        ];


        // multi sql for creating database and tables
        $create_sql = "
            CREATE DATABASE IF NOT EXISTS {$database};

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$user_table}` (`user_id` int(11) NOT NULL AUTO_INCREMENT,`first_name` varchar(100) NOT NULL,`last_name` varchar(100) NOT NULL,`email` varchar(100) NOT NULL,`password` varchar(100) NOT NULL,`role` varchar(50) NOT NULL,PRIMARY KEY (`user_id`),UNIQUE KEY `email` (`email`)) ENGINE=InnoDB;

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$movie_table}` (`movie_id` INT NOT NULL , `movie_title` VARCHAR(100) NOT NULL , `movie_plot` VARCHAR(500) NOT NULL , `movie_duration` INT NOT NULL , `movie_poster` VARCHAR(100) NOT NULL , `movie_trailer` VARCHAR(100) NOT NULL , `movie_rating` VARCHAR(10) NOT NULL , PRIMARY KEY (`movie_id`)) ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$screen_table}` (`screen_id` INT NOT NULL AUTO_INCREMENT, `screen_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`screen_id`)) ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$genre_table}` (`genre_id` INT NOT NULL AUTO_INCREMENT, `genre_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`genre_id`)) ENGINE = InnoDB;

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$has_genre_table}` (`movie` int(11) NOT null,`genre` int(11) NOT NULL, KEY `movie` (`movie`),  KEY `genre` (`genre`), CONSTRAINT `has_genre_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `has_genre_fk2` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ) ENGINE=INNODB;

            CREATE TABLE IF NOT EXISTS `{$database}`.`{$is_scheduled_for_table}` ( `movie` int(11) NOT null, `screen` int(11) NOT null,`start` int(11) NOT null, `end` int(11) NOT null,  KEY `movie` (`movie`), KEY `screen` (`screen`), CONSTRAINT `schedule_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `schedule_fk2` FOREIGN KEY (`screen`) REFERENCES `screen` (`screen_id`))ENGINE=INNODB;

        ";

        // check for duplicate screen names
        if(checkForDuplicates($screens)){
            showErrorMessage("Duplicated screen name. Please try again.","setup");
        }
        else{
            // create database and tables
            if(mysqli_multi_query($conn, $create_sql)){
                do{

                }
                while(mysqli_next_result($conn));

                // create admin user
                $admin_sql = "INSERT IGNORE INTO `{$database}`.`{$user_table}` VALUES (?,?,?,?,?,?)";
                if(!mysqli_execute_query($conn, $admin_sql, $admin_user)){
                    showErrorMessage('Error creating admin user. Please try again or contact technical support','setup');
                }
                else{
                    // populate genre table
                    if(!populateGenreTable($conn, $database, $genre_table)){
                        showErrorMessage("Error adding genres. Please try again or contact technical support.","setup");
                    }
                    else{
                        //populate screen table
                        if(populateScreenTable($conn, $database,$screen_table, $screens)){
                            session_destroy();
                            redirect('index.php');
                        }
                        else{
                            showErrorMessage("Error adding screens. Please try again or contact technical support.","setup");
                        }
                    }
                }
            }
            else{
                showErrorMessage("Error creating database. Please try again.","setup");
            }
        }

    }
    else{
        showErrorMessage("Passwords do not match. Please try again.","setup");
    }


}


function checkForDuplicates(array $list){
    foreach($list as $item){
        for($i=0;$i<count($list);$i++){
            if(strnatcasecmp($item, $list[$i]) == 0 && $i != array_search($item, $list)){
                return true;
            }
        }
    }
    return false;
}

function populateGenreTable($conn, $database, $genre_table){
    require_once('api-handler.php');
    $genre_url = "https://api.themoviedb.org/3/genre/movie/list";
    $response = fetchData($genre_url);
    $genres = $response->{'genres'};
    if(is_null($genres)){
        return false;
    }
    else{
        foreach($genres as $genre){
            $genre_id = $genre->{'id'};
            $genre_name = $genre->{'name'};
            $genre_model = [$genre_id, $genre_name];
            $sql = "INSERT IGNORE INTO `{$database}`.`{$genre_table}` VALUES (?,?)";
            if(!mysqli_execute_query($conn, $sql,$genre_model)){
                return false;
            }
        }
        return true;
    }
}

function populateScreenTable($conn, $database, $screen_table, $screens){
    foreach($screens as $screen){
        $screen_model = ['',$screen];
        $sql = "INSERT INTO `{$database}`.`{$screen_table}` VALUES (?,?)";
        if(!mysqli_execute_query($conn, $sql, $screen_model)){
            return false;
        }
    }
    return true;
}



?>


<div class="h-full w-full bg-gray-700 p-4">
    <h1 class="text-4xl text-center text-slate-200 font-light pb-12">Initial Setup</h1>
    <div class="flex  justify-around items-center w-4/5 h-4/5 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 max-h-[480px] p-4 ">

        <div class="flex flex-col justify-between h-full w-1/3">
            <img class="h-full object-contain" src="./img/kisspng-clapperboard-animation-presentation-clapping-clip-movie-theatre-5ab8ef37f26f56.826720561522069303993.png" alt="">
        </div>

        <div class="h-full w-1/3">
            <form class="flex flex-col justify-between items-center h-full w-full" action="setup.php" method="post">
                <!-- Administrator details -->
                <div class="w-4/5">
                    <p class="text-xl text-white pt-4 mb-2 font-light">Administrator's information</p>
                    <input type="text" name="f-name"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* First Name" value="<?php  echo $_SESSION['db-setup'] ==0 ? $_SESSION['first-name'] : ""; ?>" required>
                    <input type="text" name="l-name"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Last Name" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['last-name'] : ""; ?>" required>
                    <input type="email" name="email"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Email" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['email'] : ""; ?>" required>
                    <input type="password" name="password"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Password" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  required>
                    <input type="password" name="c-password"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Confirm Password" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." required>
                </div>

                <!-- Screen names -->
                <div class="w-4/5">
                    <p class="text-xl text-white  pt-4 mb-2 font-light">Cinema/Screen Names</p>
                    <input type="text" name="screen-1"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-1'] : ""; ?>" required>
                    <input type="text" name="screen-2"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-2'] : ""; ?>" required>
                    <input type="text" name="screen-3"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-3'] : ""; ?>" required>
                    <input type="text" name="screen-4"  class="w-full rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-4'] : ""; ?>" required>
                </div>

                <button class="bg-amber-600 text-white font-semibold rounded-full w-4/5 py-1 mt-2">Submit</button>

            </form>
        </div>
    </div>
</div>


<?php
include_once('./partials/footer.php');
?>