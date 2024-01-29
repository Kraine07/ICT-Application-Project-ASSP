
<?php
if(!isset($_SESSION)){
    session_start();
}

require_once('message-display.php');

if(!isset($_SESSION['auth-user'])){
    showErrorMessage('Please login to access this page.','index');
}

$results = isset($_SESSION['movie-search-results'])?$_SESSION['movie-search-results']:[];

?>



<div class="flex items-center w-full h-full">
    <!-- Left panel -->
    <div class="flex flex-col justify-between bg-app-blue text-gray-200 h-full w-1/4 min-w-[200px]   banner" >
        <div class="flex flex-col items-center w-full  menu">
            <!-- Profile -->
            <div class="w-full text-center  my-8">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-36 h-28 mx-auto">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg> -->
                <img src="./img/logo_light_2.png" alt="logo" class="px-12 object-contain mb-12">
                <p class="text-2xl font-light  username"> <?php  echo $_SESSION['auth-user']['first_name']." ".$_SESSION['auth-user']['last_name'] ?> </p>
                <p class="font-light uppercase   role"> <?php  echo$_SESSION['auth-user']['role']  ?> </p>
            </div >


            <!-- Menu -->
            <div class="w-5/6 self-end my-8     menu-items  ">
                <form id="manage-movies" action="index.php" method="post"><input type="text" name="manage-movies" hidden></form>
                <form id="manage-schedules" action="index.php" method="post"><input type="text" name="manage-schedules" hidden></form>
                <form id="manage-users" action="index.php" method="post"><input type="text" name="manage-users"  hidden></form>

                <button form="manage-movies" id='movies-menu-button' class='w-full hover:bg-app-secondary font-semibold text-lg text-right pr-6  py-2 <?php  echo $_SESSION['screen']=='movie'? 'bg-app-tertiary ':'';  ?>       selected' >Manage Movies</button>
                <button form="manage-schedules" id='schedule-menu-button' class="w-full hover:bg-app-secondary font-semibold text-lg text-right pr-6 py-2 <?php  echo $_SESSION['screen']=='schedule'? 'bg-app-tertiary':'';  ?>">Manage Schedules</button>

                <!-- show user management if user is administrator -->
                <?php
                $css = $_SESSION['screen'] == 'user'? 'bg-app-tertiary ':'';
                    echo $_SESSION['auth-user']['role'] == "admin" ? "<button form='manage-users' id='users-menu-button' class=' w-full hover:bg-app-secondary font-semibold text-lg text-right px-6 py-2 {$css}    '>Manage Users</button>" :"";
                ?>

            </div>
        </div>

        <!-- Logout button -->
        <div class="flex justify-center items-center my-8">
            <form id="logout" action="logout.php" method="post"></form>
            <button form="logout" class="w-3/4 py-1 border-2 border-app-secondary text-gray-200 font-bold rounded-full hover:bg-app-secondary ">Logout</button>
        </div>
        <p class="absolute bottom-1 w-1/4 mx-auto text-center text-xs">&copy; Backyard Cinema 2023</p>
    </div>






    <!-- Section on the right(Movie, Schedule and User Management) -->
    <div id='manage-movies' class=" bg-app-tertiary items-center justify-center h-full w-3/4 text-center text-sm text-gray-200 overflow-y-auto top-1/2">





        <?php

        // load appropriate screen
        switch ($_SESSION['screen']) {
            case "movie-result-list": // show results from api
                echo
                '
                    <div class="bg-app-tertiary text-xl text-gray-200 w-full shadow-custom-sm sticky top-0 py-2 mb-4 z-30">
                        <span class="">Select a movie from the list below</span>
                    </div>
                ';
                foreach($results as $result){
                    if($result->{'original_language'} == "en"){
                        $rating_url = 'https://api.themoviedb.org/3/movie/'.$result->{'id'}.'/release_dates';
                        require('title-result.php');
                    }
                }
                break;

            case "schedule": // show schedule management screen
                require_once('schedule-main.php');
                break;

            case "user": // show user management screen
                require_once('user-main.php');
                break;
            default:
                require_once('movie-main.php'); // show movie management screen
        }

        ?>


</div>
