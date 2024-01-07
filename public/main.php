<?php
session_start();
require_once('dbConn.php');

require_once('error-handler.php');




$schedule_info_sql = "SELECT * FROM `{$database}`.`{$schedule_table}`, `{$database}`.`{$movie_table}`, `{$database}`.`{$screen_table}` WHERE `movie_id` = `movie` and `screen_id` = `screen` ORDER BY `start` DESC LIMIT 3";

$screen_sql = "SELECT * FROM `{$database}`.{$screen_table}";

$today_sql = "SELECT `movie_poster`, `movie_id`, `movie_title`, `movie_plot`, `movie_duration`,`movie_trailer`, `start`, `end`, `movie`, `screen` FROM `{$database}`.`{$schedule_table}`, `{$database}`.`{$movie_table}`, `{$database}`.`{$screen_table}` WHERE `movie` = `movie_id` AND `screen` = {$_SESSION['screen-id']} AND `screen` = `screen_id` AND FROM_UNIXTIME(`start`,'%Y-%m-%d') = CURDATE() ORDER BY `start`";


require_once('./partials/head.php');


?>



<div class=" h-full w-full bg-blue-950 overflow-y-auto   ">

    <!-- movie info modal -->
    <?php
        require_once('./partials/movie-info-modal.php');
        require_once('./partials/watch-trailer.php');
    ?>



<!-- slides -->
    <div class="slideshow relative h-full">
        <h2 class="text-white text-2xl text-center text-light py-2 bg-blue-900">Now showing</h2>
        <div class="">
            <?php
            if($result = mysqli_query($conn, $schedule_info_sql)){

                while($row = mysqli_fetch_assoc($result)){
                    echo '

                        <div  class="slides h-[420px] w-[640px] bg-white left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2  absolute rounded-lg  ">
                            <div class="flex items-center h-full w-full p-6">
                                <div class="w-1/2 h-full">
                                    <img class="object-cover h-full rounded-lg" src="'.$row['movie_poster'].' " alt="movie-poster">
                                </div>
                                <div class="flex flex-col justify-between w-1/2 h-full px-6 text-black">
                                    <div class="h-2/3 flex flex-col justify-start">
                                        <h1 class="text-2xl h-1/3 leading-6 justify-self-center ">'.$row['movie_title'].'</h1>
                                        <p class="text-xs h-2/3 overflow-clip  py-2">'.$row['movie_plot'].'</p>
                                    </div>
                                    <div class="h-1/4 flex flex-col justify-end">
                                        <div class="flex justify-between items-end w-full my-2">
                                            <div class="w-2/3">
                                                <span class="block text-2xl font-light">'.$row['screen_name'].'</span>
                                                <span class="block text-4xl text-red-700 ">'.date("g:i A",$row['start']).'</span>
                                            </div>
                                            <div class="flex justify-center items-end w-1/3  ">
                                                <p class="text-2xl">'.$row['movie_rating'].'</p>
                                            </div>
                                        </div>
                                        <form action="process-main.php" method="post">
                                            <input type="text" name="trailer-link" value="'.$row['movie_trailer'].'" hidden>
                                            <button class="bg-blue-950 text-white w-full text-2xl py-1 rounded-md flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-8 aspect-square inline">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                                </svg>
                                                Watch Trailer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    ';
                }
            }

            ?>

        </div>

        <span class="absolute left-[20%] p-2 top-1/2 text-2xl w-10  text-center  cursor-pointer text-white " onclick="nextSlide(-1)">&#10094;</span>
        <span class="absolute right-[20%] p-2 top-1/2 text-2xl w-10  text-center  cursor-pointer text-white " onclick="nextSlide(1)">&#10095;</span>

        <div class="circles z-30 text-center absolute bottom-[6%] right-1/2 translate-x-1/2">
            <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(1)"></span>
            <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(2)"></span>
            <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(3)"></span>
        </div>

    </div>


    <!-- On today -->

    <div class="h-full w-full bg-slate-300 py-12" id="on-today"  name="on-today">
        <div class="flex  p-8 w-full">
            <span class="text-4xl w-1/4 text-black mb-12  ">On Today</span>
            <div class="flex justify-start w-1/2  ">
                <?php

                // select screen buttons
                if($result = mysqli_query($conn, $screen_sql)){
                    while($screen = mysqli_fetch_assoc($result)){
                        // $bg;
                        // $text_col;
                        if($screen['screen_id'] == $_SESSION['screen-id']){
                            $bg = "bg-blue-950";
                            $text_col = "text-white";
                        }
                        else{
                            $bg= "bg-white";
                            $text_col = "text-blue-950";
                        }


                        // screen buttons
                        echo '
                            <form action="process-main.php" method="post" class="w-full">
                                <input type="text" name="screen-id" value="'.$screen['screen_id'].'" hidden>
                                <button class="'.$bg.' '.$text_col.' text-black text-md py-1 px-10 w-auto mx-4  focus:outline-none border border-blue-950 capitalize rounded-md">'.$screen['screen_name'].'</button>
                            </form>
                            ';

                    }
                }

                ?>
            </div>
        </div>



        <!-- movie cards -->

        <div class="movie h-auto w-5/6 grid grid-cols-4 gap-4 mx-auto text-black ">
            <?php
                if($result = mysqli_query($conn, $today_sql)){

                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                            <div class=" group  h-full w-4/5     relative    " >
                                <img class="object-contain w-full " src="'.$row['movie_poster'].'" alt="movie-poster">
                                <div>
                                    <h5 class="bg-[#ffffff88] w-full py-1 text-center text-blue-950 text-xl font-bold absolute bottom-0">'.date("g:i A",$row['start']).'</h5>
                                </div>
                                <form action="process-main.php" method="post">
                                    <input type="text" name="movie-id" value="'.$row['movie_id'].'" hidden>
                                    <button class=" bg-white w-2/3 py-1 ani-slide-down absolute top-1/2  left-1/2  -translate-x-1/2 rounded-full hidden group-hover:block  ">View details</button>
                                </form>
                            </div>
                        ';
                    }
                }

            ?>

        </div>

    </div>

</div>

<?php


require_once('./partials/footer.php');


?>