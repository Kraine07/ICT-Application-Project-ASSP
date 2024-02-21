
<?php
if(!isset($_SESSION)){
    session_start();
}

require_once('message-display.php');

// prevents user from accessing via the address bar
if(!isset($_SESSION['auth-user'])){
    showErrorMessage('Please login to access this page.','index');
}

$results = isset($_SESSION['movie-search-results'])?$_SESSION['movie-search-results']:[];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // get movie data from api
    if(isset($_POST['movie-id'])){
        $movie_id = $_POST['movie-id'];
        $movie_url = "https://api.themoviedb.org/3/movie/{$movie_id}?append_to_response=release_dates,videos,credits&language=en-US";
        $response = fetchData($movie_url);
        $release_dates = $response->{'release_dates'}->{'results'};
        $videos = $response->{'videos'}->{'results'};


        $title = $response->{'original_title'};
        $plot = $response->{'overview'};
        $duration = $response->{'runtime'};
        $poster = 'https://image.tmdb.org/t/p/original'.$response->{'poster_path'};
        $rating='';
        $trailer ='';
        $release_date = date_format(date_create($response->{'release_date'}),'U'); // convert to unix time
        $genres = $response->{'genres'};
        $cast_details = $response->{'credits'}->{'cast'};
        $cast=[];


        // rating
        foreach($release_dates as $rd){
            if($rd->{'iso_3166_1'} == 'US'){
                $rating = $rd->{'release_dates'}[0]->{'certification'};
            }
        }

        // trailer link
        foreach($videos as $video){
            $key = $video->{'key'};

            if($video->{'type'} == 'Trailer'){
                $trailer = 'https://www.youtube.com/embed/'.$key.'?autoplay=1&mute=0&controls=1';
                break;
            }

        }

        // if no cast details is returned
        if(empty($cast_details)){
            array_push($cast,"Not available");
        }
        else{

            // populate cast array with the max 3 main actors/actresses

            foreach($cast_details as $cd){
                if($cd->{'order'} <3){
                    array_push($cast,  $cd->{'name'} );
                }
            }
        }



        // display movie details
        require_once('./partials/movie-details.php');
    }

}

?>

<!-- update password form -->
<div class="hidden absolute w-screen h-screen top-0 left-0 bg-app-modal text-gray-200  z-20" id="update-password-modal">
    <div class="absolute w-1/3  bg-app-tertiary left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 ">
        <span class="flex justify-between items-center pl-8 pr-4 py-2 bg-app-blue text-lg">
            <span>Update Password</span>
            <button class="" id="update-password-close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </span>
        <div class="w-full py-6 px-8">
            <p class="text-xs italic mb-4">Required fields <span class="text-app-orange">*</span></p>
            <form action="update-password.php" method="post" class="w-full text-sm flex flex-col  group" novalidate>

            <!-- Old Password -->
            <div class="mt-1 w-full flex flex-col">
                <label for="old-password" class="">Old Password<span class="text-app-orange"> *</span></label>
                <input required id="old-password" type="password" name="old-password" class="text-app-blue font-semibold  outline-none ring-0 py-1 px-2 mt-1  rounded-sm focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." placeholder=" ">
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid email address
                </span>
            </div>


            <!-- New password -->
            <div class="mt-1 w-full flex flex-col">
                <label for="new-password" class="">New Password<span class="text-app-orange"> *</span></label>
                <input required id="new-password" type="password" name="new-password" class="text-app-blue font-semibold  outline-none ring-0 py-1 px-2 mt-1  rounded-sm focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." placeholder=" ">
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid email address
                </span>
            </div>


            <!-- Confirm password -->
            <div class="mt-1 w-full flex flex-col">
                <label for="confirm-password" class="">Confirm New Password<span class="text-app-orange"> *</span></label>
                <input required id="confirm-password" type="password" name="confirm-password" class="text-app-blue font-semibold  outline-none ring-0 py-1 px-2 mt-1  rounded-sm focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." placeholder=" ">
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Please enter a valid email address
                </span>
            </div>

                <button class="mt-4 px-6 py-2 bg-app-blue text-app-orange w-full rounded-md   group-invalid:pointer-events-none group-invalid:opacity-30">Update Password</button>
            </form>
        </div>
    </div>
</div>





<div class="flex items-center w-full h-full">
    <!-- Left panel -->
    <div class="flex flex-col justify-between bg-app-blue text-gray-200 h-full w-1/4 min-w-[200px]   " >
        <div class="flex flex-col justify-between items-center h-full w-full  ">
            <!-- Profile -->
            <div class="w-full text-center  mt-8">

                <!-- logo -->
                <img src="./img/logo_new_light.png" alt="logo" class="px-12 object-contain">

                <!-- user info -->
                <p class="text-3xl font-light mt-6 mb-1 capitalize"> <?php  echo $_SESSION['auth-user']['first_name']." ".$_SESSION['auth-user']['last_name'] ?> </p>
                <p class="font-light uppercase   "> <?php  echo$_SESSION['auth-user']['role']  ?> </p>

                <div class="flex w-4/5 items-end justify-center  mx-auto  mt-2 ">

                    <!-- Update password button -->
                    <button id="update-password-btn" class="flex items-center justify-center text-xs  p-2 mx-1 hover:px-4 rounded-md  group duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="aspect-square h-5 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <span class="ml-1 hidden group-hover:inline">Update Password</span>
                    </button>

                    <!-- Logout button -->
                    <form action="logout.php" method="post" class="  text-xs m-0 p-0" >
                        <button  class="flex  justify-center items-center p-2 mx-1 hover:px-4  rounded-md  group duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="aspect-square h-5 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <span class="ml-1 hidden group-hover:inline">Logout</span>
                        </button>
                    </form>

                </div>
            </div >


            <!-- Menu -->
            <div class="w-2/3 self-end pb-8   ">

                <form id="manage-movies" action="index.php" method="post"><input type="text" name="manage-movies" hidden></form>
                <form id="manage-schedules" action="index.php" method="post"><input type="text" name="manage-schedules" hidden></form>
                <form id="manage-users" action="index.php" method="post"><input type="text" name="manage-users"  hidden></form>

                <button form="manage-movies" id='movies-menu-button' class='w-full hover:bg-app-secondary font-semibold text-lg text-right pr-6  py-2 <?php  echo $_SESSION['screen'] != 'schedule' && $_SESSION['screen'] !='user'? 'bg-app-tertiary text-app-orange ':'';  ?>       selected' >Manage Movies</button>
                <button form="manage-schedules" id='schedule-menu-button' class="w-full hover:bg-app-secondary font-semibold text-lg text-right pr-6 py-2 <?php  echo $_SESSION['screen']=='schedule'? 'bg-app-tertiary text-app-orange':'';  ?>">Manage Schedules</button>

                <!-- show user management if user is administrator -->
                <?php
                $css = $_SESSION['screen'] == 'user'? 'bg-app-tertiary text-app-orange ':'';
                    echo $_SESSION['auth-user']['role'] == "administrator" ? "<button form='manage-users' id='users-menu-button' class=' w-full hover:bg-app-secondary font-semibold text-lg text-right px-6 py-2 {$css}    '>Manage Users</button>" :"";
                ?>

            </div>

            <div class="flex flex-col w-full">
                <p class=" text-center text-xs pb-2">&copy; Backyard Cinema 2023</p>
            </div>
        </div>

    </div>



    <!-- Section on the right(Movie, Schedule and User Tables) -->
    <div id='manage-movies' class=" bg-app-tertiary items-center justify-center h-full w-3/4 text-center text-sm text-gray-200 overflow-y-auto top-1/2">


        <?php

        // load appropriate screen
        switch ($_SESSION['screen']) {
            case "movie-result-list": // show results from api
                echo
                '
                    <div class="bg-app-tertiary text-xl text-gray-200 w-full border-b border-app-blue sticky top-0 py-2 mb-4 z-30">
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
