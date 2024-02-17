<?php

require_once('redirect.php');

session_start();


$_SESSION['patron-view'] = false;

// redirect if setup already done
if($_SESSION['db-setup'] == 1){
    redirect('index.php');
}


require_once('form-validation.php');
require_once('./partials/head.php');
require_once('dbConn.php');
require_once('redirect.php');

require_once('message-display.php');


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

    // created to be used when validating for empty fields
    $form_data = [
        $_POST['f-name'],
        $_POST['l-name'],
        $_POST['email'],
        $_POST['password'],
        $_POST['c-password'],
        $_POST['screen-1'],
        $_POST['screen-2'],
        $_POST['screen-3'],
        $_POST['screen-4']
    ];

    // user and screen names to be added to the database
    $admin_user = [
        1001,
        $_SESSION['first-name'],
        $_SESSION['last-name'],
        $_SESSION['email'],
        hash("sha256",$_SESSION['password']),
        "administrator"
    ];


    $screen_names = [
        $_SESSION['screen-1'],
        $_SESSION['screen-2'],
        $_SESSION['screen-3'],
        $_SESSION['screen-4']
    ];


    // multi sql for creating database and tables
    $create_db = "
        CREATE DATABASE IF NOT EXISTS {$database};

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$user_table}` (`user_id` int(11) NOT NULL AUTO_INCREMENT,`first_name` varchar(100) NOT NULL,`last_name` varchar(100) NOT NULL,`email` varchar(100) NOT NULL,`password` varchar(100) NOT NULL,`role` varchar(50) NOT NULL,PRIMARY KEY (`user_id`),UNIQUE KEY `email` (`email`)) ENGINE=InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$movie_table}` (`movie_id` INT NOT NULL , `movie_title` VARCHAR(100) NOT NULL , `movie_plot` VARCHAR(500) NOT NULL ,`movie_release_date` INT NOT NULL, `movie_duration` INT NOT NULL , `movie_poster` VARCHAR(100) NOT NULL , `movie_trailer` VARCHAR(100) NOT NULL , `movie_rating` VARCHAR(10) NOT NULL , PRIMARY KEY (`movie_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$screen_table}` (`screen_id` INT NOT NULL AUTO_INCREMENT, `screen_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`screen_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$genre_table}` (`genre_id` INT NOT NULL AUTO_INCREMENT, `genre_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`genre_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$has_genre_table}` (`movie` int(11) NOT null,`genre` int(11) NOT NULL, KEY `movie` (`movie`),  KEY `genre` (`genre`), CONSTRAINT `has_genre_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `has_genre_fk2` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ) ENGINE=INNODB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$schedule_table}` (`schedule_id` int(11) NOT NULL AUTO_INCREMENT, `movie` int(11) NOT null, `screen` int(11) NOT null, `user` int(11) NOT null, `start` int(11) NOT null, `end` int(11) NOT null,  KEY `movie` (`movie`), KEY `screen` (`screen`), KEY `user` (`user`), CONSTRAINT `schedule_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `schedule_fk2` FOREIGN KEY (`screen`) REFERENCES `screen` (`screen_id`), CONSTRAINT `schedule_fk3` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`), PRIMARY KEY (`schedule_id`))ENGINE=INNODB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$cast_table}` (`movie` INT(11) NOT NULL , `cast_name` VARCHAR(100) NOT NULL , KEY (`movie`), CONSTRAINT `cast_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`)) ENGINE = InnoDB;

    ";


    $admin_sql = "INSERT IGNORE INTO `{$database}`.`{$user_table}` VALUES (?,?,?,?,?,?)";

    // validate submitted data
    if(!emptyFields($form_data)){
        if(validEmail($_SESSION['email'])){
            if(checkForDuplicates( [ $_SESSION['password'], $_SESSION['c-password'] ] )){
                if(validPassword("Admin123")){
                    if(!checkForDuplicates($screen_names)){

                        // create database and tables
                        if(mysqli_multi_query($conn, $create_db)){
                            //execute subsequent queries
                            do{}while(mysqli_next_result($conn));

                            // create admin user
                            if(!mysqli_execute_query($conn, $admin_sql, $admin_user)){
                                showErrorMessage('Error creating admin user. Please try again or contact technical support','init');
                            }
                            else{
                                // populate genre table
                                if(!populateGenreTable($conn, $database, $genre_table)){
                                    showErrorMessage("Error adding genres. Please try again or contact technical support.","init");
                                }
                                else{
                                    //populate screen table
                                    if(!populateScreenTable($conn, $database,$screen_table, $screen_names)){
                                        showErrorMessage("Error adding screens. Please try again or contact technical support.","init");
                                    }
                                    else{
                                        session_destroy();
                                        showSuccessMessage("Database created and initialized.");
                                    }
                                }
                            }

                        }
                        else{
                            showErrorMessage("Error creating database. Please try again.","init");
                        }

                    }
                    else{
                        showErrorMessage("Duplicated screen name. Please try again.", "init");
                    }

                }
                else{
                    showErrorMessage("Invalid password format. Password must be minimum 8 characters with at least one numeral and uppercase character.", "init");
                }
            }
            else{
                showErrorMessage("Passwords do not match. Please try again.", "init");
            }

        }
        else{
            showErrorMessage("Invalid email format. Please try again.", "init");
        }
    }
    else{
        showErrorMessage("Empty fields not allowed. Please try again.", "init");
    }

}

// retrieve a list of all genres from the API then add them to the genre table
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


// add screen names submitted in the setup form to the the screen table
function populateScreenTable($conn, $database, $screen_table, $screens){
    foreach($screens as $screen){
        $screen_model = ['',$screen];
        $sql = "INSERT IGNORE INTO `{$database}`.`{$screen_table}` VALUES (?,?)";
        if(!mysqli_execute_query($conn, $sql, $screen_model)){
            return false;
        }
    }
    return true;
}

?>


<!-- Setup form -->
<div class="w-screen h-screen bg-app-modal">
    <div class="h-auto w-2/5  bg-app-tertiary mx-auto text-gray-200 absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 rounded-md">
        <h1 class="text-2xl text-left px-8  py-1 bg-app-blue rounded-t-md">Initial Setup</h1>
        <div class="flex  justify-around items-center w-full h-auto py-4 px-8 ">


            <div class="h-auto w-full font-light  ">

                <form class="flex flex-col justify-between items-center h-full w-full overflow-y-auto   group" action="init.php" method="post" novalidate>

                    <!-- Administrator details -->
                    <div class="w-full">
                        <p class="text-xl font-normal ">Administrator's information</p>

                        <div class="flex justify-end w-full px-4 mb-2">
                            <span class="text-xs  italic  w-2/3  float-right ">Required fields<span class="ml-1 text-sm text-app-orange">*</span> </span>
                        </div>

                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="f-name" class="text-sm font-normal">First Name <span class=" text-app-orange">*</span></label>
                            <input type="text" name="f-name" id="f-name" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo $_SESSION['db-setup'] ==0 ? $_SESSION['first-name'] : ""; ?>" placeholder="First Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="l-name" class="text-sm font-normal">Last Name <span class=" text-app-orange">*</span></label>
                            <input type="text" name="l-name" id="l-name" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['last-name'] : ""; ?>" placeholder="Last Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="email" class="text-sm font-normal">Email <span class=" text-app-orange">*</span></label>
                            <input type="email" name="email" id="email"  class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['email'] : ""; ?>" placeholder="Email" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="password" class="text-sm font-normal">Password <span class=" text-app-orange">*</span></label>
                            <input type="password" name="password" id="password" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  placeholder="Password" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="c-password" class="text-sm font-normal">Confirm Password <span class=" text-app-orange">*</span></label>
                            <input type="password" name="c-password" id="c-password" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <!-- Screen names -->
                    <div class="w-full">
                        <p class="text-xl font-normal mt-3 mb-2">Cinema/Screen Names</p>

                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="screen-1" class="text-sm font-normal">First screen <span class=" text-app-orange">*</span></label>
                            <input type="text" name="screen-1" id="screen-1"  class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-1'] : ""; ?>" placeholder="First Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="screen-2" class="text-sm font-normal">Second screen <span class=" text-app-orange">*</span></label>
                            <input type="text" name="screen-2" id="screen-2" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-2'] : ""; ?>" placeholder="Second Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="screen-3" class="text-sm font-normal">Third Screen <span class=" text-app-orange">*</span></label>
                            <input type="text" name="screen-3" id="screen-3" class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-3'] : ""; ?>" placeholder="Third Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4 mb-2">
                            <label for="screen-4" class="text-sm font-normal">Fourth Screen <span class=" text-app-orange">*</span></label>
                            <input type="text" name="screen-4"id="screen-4"  class="w-2/3   rounded-sm text-app-blue text-xs  font-semibold border-none outline-none ring-0 ml-4 px-2 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-4'] : ""; ?>" placeholder="Fourth Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full px-4">
                            <button class=" bg-app-blue text-app-orange font-semibold rounded w-2/3  py-1 mt-2   group-invalid:pointer-events-none group-invalid:opacity-30">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>






<?php
include_once('./partials/footer.php');
?>