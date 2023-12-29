<?php
$movie_sql = "SELECT `movie_id`,`movie_title` FROM `{$database}`.`{$movie_table}`";
$movie_result = mysqli_query($conn, $movie_sql); //TODO HANDLE ERROR

$screen_sql = "SELECT * FROM `{$database}`.`{$screen_table}`";
$screen_result = mysqli_query($conn, $screen_sql); //TODO HANDLE ERROR



?>




<!--  Schedule form modal window -->
<div id="schedule-form" class="absolute top-0 left-0 bg-[#838383cc]  w-full h-full hidden" >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[400px] w-[300px] border-2 border-blue-950 bg-white" >
        <h1 class="text-white text-lg text-left bg-blue-950 w-full px-[24px] py-2"> <?php    ?>  New schedule
            <button class="float-right inline-block" id="close-schedule-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>
        <form action="index.php" method="post" class="flex flex-col justify-between items-start w-full h-full p-[24px]">
            <div class="flex flex-col items-start w-full">
                <label for="movie" class="text-md font-semibold"><span class="text-red-600">* </span>Movie</label>
                <select name="movie" id="movie" class="bg-white w-3/4 py-1" required>
                    <option  hidden>Choose movie</option>
                    <?php
                    // print each movie title as an option
                    while($movie = mysqli_fetch_assoc($movie_result))
                    echo "
                        <option class='py-1 ' value=".$movie['movie_id']."> {$movie['movie_title']} </option>
                ";
                    ?>
                </select>
            </div>
            <div class="flex flex-col items-start w-full">
                <label for="screen"><span class="text-red-600">* </span>Screen</label>
                <select name="screen" id="screen" class="bg-white w-3/4 py-1 " required>
                    <option  hidden>Choose screen</option>
                    <?php
                    // print each screen name as an option
                    while($screen = mysqli_fetch_assoc($screen_result))
                        echo "
                            <option class='py-1 ' value=".$screen['screen_id']."> {$screen['screen_name']} </option>
                    ";
                    ?>
                </select>
            </div>
            <div class="flex flex-col items-start">
                <label for=""><span class="text-red-600">* </span>Start</label>
                <input type="datetime-local" name="start" class="py-1 border border-slate-200" required>
            </div>
            <div class="flex flex-col items-start">
                <label for=""><span class="text-red-600">* </span>End</label>
                <input type="datetime-local" class="" name="end" require_once>
            </div>
            <button class="bg-blue-950 text-white w-full p-2">Submit</button>
        </form>
    </div>

</div>