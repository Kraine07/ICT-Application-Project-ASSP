
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



<div class="flex items-center">
    <div class=" w-1/4 h-screen bg-slate-600 ">
        <span class="mx-20">ADMIN PANEL</span>
        <form id="logout" action="logout.php" method="post"></form>
        <button form="logout" class="px-4 py-1 bg-slate-200 rounded-full">Logout</button>
        <button id="search-movie-btn" class="bg-green-300 px-12 py-2 mt-12 rounded-lg block">Find Movie</button>
    </div>

    <div class="w-3/4 h-screen bg-slate-300">

    <?php

        if($_SESSION['screen'] == "list"){

            foreach($results as $result){
                if($result->{'original_language'} == "en"){
                    $rating_url = 'https://api.themoviedb.org/3/movie/'.$result->{'id'}.'/release_dates';
                    require('title-result.php');
                }

            }

        }
        elseif($_SESSION['screen'] == "details"){

        }
        else{
            require_once('movie-main.php');
        }
    ?>

    </div>

    <div id="search-movie-form" class="absolute top-0 left-0 bg-[#000000aa] hidden w-screen h-screen" >
        <div class="absolute flex flex-col justify-center items-center top-1/3 left-1/3 w-1/3 h-1/4 bg-green-200" >
            <h1 class="text-xl text-center mb-8">Find movie by title</h1>
            <form action="index.php" method="post">
                <div class="inline-flex  ">
                    <input class="border-2 border-slate-300 focus:ring  focus:outline-none  type="text" name="movie_search" id="movie_search" required autofocus>
                    <button class="bg-slate-300 px-4">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
