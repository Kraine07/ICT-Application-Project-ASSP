<?php

require_once('dbConn.php');
require_once('error-handler.php');


$schedule_info_sql = "SELECT * FROM `{$database}`.`{$schedule_table}`, `{$database}`.`{$movie_table}`, `{$database}`.`{$screen_table}` WHERE `movie_id` = `movie` and `screen_id` = `screen` ORDER BY `start` LIMIT 3";
$screen_sql = "SELECT `screen_name` FROM `{$database}`.{$screen_table}";



require_once('./partials/head.php');


?>


    <!-- Slide -->
        <div class=" h-full w-full bg-blue-950 overflow-y-auto   ">
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
                                        <h1 class="text-2xl ">'.$row['movie_title'].'</h1>
                                        <p class="text-xs h-2/5  ">'.$row['movie_plot'].'</p>
                                        <div class="flex justify-between w-full">
                                            <div class="w-3/4">
                                                <span class="block text-2xl font-light">Cinema '.$row['screen_name'].'</span>
                                                <span class="block text-xl text-red-700 ">'.date("g:i A",$row['start']).'</span>
                                            </div>
                                            <div class="flex justify-end items-end text-2xl p-2 w-1/3 text-center ">
                                                <p>'.$row['movie_rating'].'</p>
                                            </div>
                                        </div>
                                        <button class="bg-blue-950 text-white w-full text-2xl py-2 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 aspect-square inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                                            </svg>
                                            Watch Trailer
                                        </button>
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

                <div class="circles z-50 text-center absolute bottom-[6%] right-1/2 translate-x-1/2">
                    <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(1)"></span>
                    <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(2)"></span>
                    <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(3)"></span>
                </div>

            </div>


            <!-- On today -->

            <div class="h-full bg-slate-400">
                <div class="p-8">
                    <h1 class="text-4xl text-black mb-12">On Today</h1>
                    <div class="flex justify-between px-40">
                        <?php

                        if($result = mysqli_query($conn, $screen_sql)){
                            while($screen = mysqli_fetch_assoc($result)){
                                echo '
                                <button class=" text-black text-md py-1 w-[160px] mx-10  focus:bg-blue-950 focus:text-white focus:outline-none border border-blue-950 capitalize rounded-md">'.$screen['screen_name'].'</button>
                                ';
                            }
                        }

                        ?>
                    </div>
                </div>




                <div class="movie h-4/5 w-5/6 grid grid-cols-4 gap-4 mx-auto text-black">
                    <?php

                    echo '
                        <div class="h-full w-4/5 ">
                            <span class="block text-center">Movie Title</span>
                            <img class="object-cover" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
                            <div class="flex justify-around text-xl font-bold">
                                <span>5:30PM</span>
                                <span>5:30PM</span>
                            </div>

                        </div>
                    ';
                    ?>
                    
                </div>

            </div>

        </div>

<?php
require_once('./partials/footer.php');
?>