
<?php
if(!isset($_SESSION)){
    session_start();
}

require_once('error-handler.php');

if($_SESSION['auth-user'] == false){
    showErrorMessage('Please login to access this page.','index');
}



$results = $_SESSION['movie-search-results'];

?>



<div class="flex items-center w-screen h-screen">
    <!-- Left panel -->
    <div class="flex flex-col justify-between bg-blue-950 text-white h-screen w-1/4 min-w-[160px]   banner" >
        <div class="flex flex-col items-center w-full  menu">
            <!-- Profile -->
            <div class="w-full text-center  my-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-36 h-28 mx-auto">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>
                <p class="text-4xl font-light  username">John Doe</p>
                <p class="font-light   role">ADMINISTRATOR</p>
            </div >


            <!-- Menu -->
            <div class="w-5/6 self-end my-8     menu-items  ">
                <form id="manage-movies" action="index.php" method="post"><input type="text" name="manage-movies" hidden></form>
                <form id="manage-schedules" action="index.php" method="post"><input type="text" name="manage-schedules" hidden></form>
                <form id="manage-users" action="index.php" method="post"><input type="text" name="manage-users"  hidden></form>

                <button form="manage-movies" id='movies-menu-button' class='w-full font-semibold text-lg  py-2 <?php  echo $_SESSION['screen']=='movie'? 'bg-white text-blue-950':'';  ?>       selected' >Manage Movies</button>
                <button form="manage-schedules" id='schedule-menu-button' class="w-full font-semibold text-lg py-2 <?php  echo $_SESSION['screen']=='schedule'? 'bg-white text-blue-950':'';  ?>">Manage Schedules</button>
                <button form="manage-users" id='users-menu-button' class=" w-full font-semibold text-lg py-2 <?php  echo $_SESSION['screen']=='user'? 'bg-white text-blue-950':'';  ?>">Manage Users</button>
            </div>
        </div>

        <!-- Logout button -->
        <div class="flex justify-center items-center my-8">
            <form id="logout" action="logout.php" method="post"></form>
            <button form="logout" class="w-3/4 py-1 bg-slate-200 text-blue-950 font-bold rounded-full hover:bg-slate-400">Logout</button>
        </div>
        <p class="absolute bottom-1 w-1/4 text-center text-xs">&copy; Backyard Cinema 2023</p>
    </div>






    <!-- Page on the right(Movie Management) -->
    <div id='manage-movies' class=" bg-[#d9d9d9] items-center justify-center h-screen w-3/4 text-center text-sm   selection">





        <?php

        // load appropriate screen
        switch ($_SESSION['screen']) {
            case "movie-result-list":
                foreach($results as $result){
                    if($result->{'original_language'} == "en"){
                        $rating_url = 'https://api.themoviedb.org/3/movie/'.$result->{'id'}.'/release_dates';
                        require('title-result.php');
                    }
                }
                break;

            case "schedule":
                require_once('schedule-main.php');
                break;

            case "user":
                echo "User screen goes here";
                break;
            default:
                require_once('movie-main.php');
        }

        ?>




    <!-- Search movie title modal window -->
    <div id="search-movie-form" class="absolute top-0 left-0 bg-[#838383cc] hidden w-screen h-screen" >
        <div class="absolute flex flex-col items-center  top-1/3 left-1/3 h-[160px] w-[380px] border-2 border-blue-950 bg-white" >
            <h1 class="text-xl text-white w-full bg-blue-950 p-4 py-2  ">Search for title</h1>
            <form action="index.php" method="post" class="w-4/5 h-2/3 flex items-center ">
                <div class="flex w-full justify-center items-center ">
                    <input class="w-3/4 border border-blue-950 px-2 py-1 focus:border-2 focus:outline-none"  type="text" name="search_movie" id="movie_search" placeholder="Movie Title" required autofocus>
                    <button class="bg-blue-950 text-white p-2 py-1 border border-blue-950">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
