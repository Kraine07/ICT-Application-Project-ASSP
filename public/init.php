<?php



session_start();


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

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$movie_table}` (`movie_id` INT NOT NULL , `movie_title` VARCHAR(100) NOT NULL , `movie_plot` VARCHAR(500) NOT NULL , `movie_duration` INT NOT NULL , `movie_poster` VARCHAR(100) NOT NULL , `movie_trailer` VARCHAR(100) NOT NULL , `movie_rating` VARCHAR(10) NOT NULL , PRIMARY KEY (`movie_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$screen_table}` (`screen_id` INT NOT NULL AUTO_INCREMENT, `screen_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`screen_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$genre_table}` (`genre_id` INT NOT NULL AUTO_INCREMENT, `genre_name` VARCHAR(100) NOT NULL , PRIMARY KEY (`genre_id`)) ENGINE = InnoDB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$has_genre_table}` (`movie` int(11) NOT null,`genre` int(11) NOT NULL, KEY `movie` (`movie`),  KEY `genre` (`genre`), CONSTRAINT `has_genre_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `has_genre_fk2` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`) ) ENGINE=INNODB;

        CREATE TABLE IF NOT EXISTS `{$database}`.`{$schedule_table}` (`schedule_id` int(11) NOT NULL AUTO_INCREMENT, `movie` int(11) NOT null, `screen` int(11) NOT null, `user` int(11) NOT null, `start` int(11) NOT null, `end` int(11) NOT null,  KEY `movie` (`movie`), KEY `screen` (`screen`), KEY `user` (`user`), CONSTRAINT `schedule_fk1` FOREIGN KEY (`movie`) REFERENCES `movie` (`movie_id`), CONSTRAINT `schedule_fk2` FOREIGN KEY (`screen`) REFERENCES `screen` (`screen_id`), CONSTRAINT `schedule_fk3` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`), PRIMARY KEY (`schedule_id`))ENGINE=INNODB;

    ";


    $admin_sql = "INSERT IGNORE INTO `{$database}`.`{$user_table}` VALUES (?,?,?,?,?,?)";

    // validate submitted data
    if(!emptyFields($form_data)){
        if(validEmail($_SESSION['email'])){
            if(checkForDuplicates( ["eeee", "eeee"] )){
                if(validPassword("Admin123")){
                    if(!checkForDuplicates($screen_names)){

                        // create database and tables
                        if(mysqli_multi_query($conn, $create_db)){
                            //execute subsequent queries
                            do{}while(mysqli_next_result($conn));

                            // create admin user
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
                                    if(!populateScreenTable($conn, $database,$screen_table, $screen_names)){
                                        showErrorMessage("Error adding screens. Please try again or contact technical support.","setup");
                                    }
                                    else{
                                        // TODO display success message
                                        session_destroy();
                                        showSuccessMessage("Setup process completed successfully.");
                                        // redirect('index.php');
                                    }
                                }
                            }

                        }
                        else{
                            showErrorMessage("Error creating database. Please try again.","setup");
                        }

                    }
                    else{
                        showErrorMessage("Duplicated screen name. Please try again.", "setup");
                    }

                }
                else{
                    showErrorMessage("Invalid password format. Password must be minimum 8 characters with at least one numeral and uppercase character.", "setup");
                }
            }
            else{
                showErrorMessage("Passwords do not match. Please try again.", "setup");
            }

        }
        else{
            showErrorMessage("Invalid email format. Please try again.", "setup");
        }
    }
    else{
        showErrorMessage("Empty fields not allowed. Please try again.", "setup");
    }

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
    <div class="h-auto w-4/5 min-w-[1000px] bg-app-tertiary mx-auto text-gray-200 absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 ">
        <h1 class="text-3xl text-center font-light py-2 bg-app-blue">Initial Setup</h1>
        <div class="flex  justify-around items-center w-full h-auto  p-3 ">

            <div class="h-full w-1/3">
                <img class="w-full object-contain" src="./img/kisspng-clapperboard-animation-presentation-clapping-clip-movie-theatre-5ab8ef37f26f56.826720561522069303993.png" alt="setup_img">
            </div>

            <div class="h-auto w-2/3 font-light  ">

                <form class="flex flex-col justify-between items-center h-full w-full overflow-y-auto" action="init.php" method="post">

                    <!-- Administrator details -->
                    <div class="w-4/5">
                        <p class="text-xl font-semibold ">Administrator's information</p>
                        <p class="text-xs  italic mb-2 w-2/3 inline float-right ">Required fields<span class="ml-1 text-lg text-app-orange">*</span> </p>
                        <div class="flex justify-end w-full">
                            <label for="f-name">First Name <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="f-name" id="f-name" class="w-2/3  rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo $_SESSION['db-setup'] ==0 ? $_SESSION['first-name'] : ""; ?>" placeholder="First Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="l-name">Last Name <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="l-name" id="l-name" class=" w-2/3 rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['last-name'] : ""; ?>" placeholder="Last Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="email">Email <span class="text-lg text-app-orange">*</span></label>
                            <input type="email" name="email" id="email"  class=" w-2/3 rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['email'] : ""; ?>" placeholder="Email" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="password">Password <span class="text-lg text-app-orange">*</span></label>
                            <input type="password" name="password" id="password" class=" w-2/3 rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  placeholder="Password" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="c-password">Confirm Password <span class="text-lg text-app-orange">*</span></label>
                            <input type="password" name="c-password" id="c-password" class=" w-2/3 rounded-sm py-[2px] text-app-blue font-semibold  ml-4 mb-2 px-2"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." placeholder="Confirm Password" required>
                        </div>
                    </div>

                    <!-- Screen names -->
                    <div class="w-4/5">
                        <p class="text-xl font-semibold mt-3 mb-2">Cinema/Screen Names</p>

                        <div class="flex justify-end w-full">
                            <label for="screen-1">First screen <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="screen-1" id="screen-1"  class="w-2/3  rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-1'] : ""; ?>" placeholder="First Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="screen-2">Second screen <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="screen-2" id="screen-2" class="w-2/3  rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-2'] : ""; ?>" placeholder="Second Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="screen-3">Third Screen <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="screen-3" id="screen-3" class="w-2/3  rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-3'] : ""; ?>" placeholder="Third Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <label for="screen-4">Fourth Screen <span class="text-lg text-app-orange">*</span></label>
                            <input type="text" name="screen-4"id="screen-4"  class="w-2/3 rounded-sm py-[2px] text-app-blue font-semibold ml-4 mb-2 px-2"  value="<?php  echo ($_SESSION['db-setup']==0) ? $_SESSION['screen-4'] : ""; ?>" placeholder="Fourth Screen Name" required>
                        </div>
                        <div class="flex justify-end w-full">
                            <button class=" bg-app-blue text-app-orange font-semibold rounded-md w-2/3 py-1 mt-2">Submit</button>
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