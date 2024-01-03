<?php
if(!isset($_SESSION)){
    session_start();
}

$movie_sql = "SELECT `movie_id`,`movie_title` FROM `{$database}`.`{$movie_table}`";
if(!$movie_result = mysqli_query($conn, $movie_sql)){
    showErrorMessage("Error retrieving movies. Please try again or contact technical support.");
}

$screen_sql = "SELECT * FROM `{$database}`.`{$screen_table}`";
if(!$screen_result = mysqli_query($conn, $screen_sql)){
    showErrorMessage("Error retrieving screens. Please try again or contact technical support.");
}


?>


<!--  Schedule form modal window -->
<div id="schedule-form" class="absolute top-0 left-0 bg-[#838383cc]  w-full h-full    <?php echo $_SESSION['schedule-edit'] ? "": "hidden" ?>   " >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[400px] w-[300px] border-2 border-blue-950 bg-slate-300" >
        <h1 class="text-white text-lg text-left bg-blue-950 w-full px-[24px] py-2"><?php echo $_SESSION['schedule-edit']? "Edit": "New";?> Schedule
            <button class="float-right inline-block" id="close-schedule-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>
        <!-- schedule form -->
        <form action="index.php" method="post" class="flex flex-col justify-between items-start w-full h-full p-[24px]">
            <input type="text" name="schedule-id" value=" <?php echo $_SESSION['schedule-edit'] ? $_SESSION['schedule-id']:"";  ?>  " hidden>
            <div class="flex flex-col items-start w-full">
                <label for="movie" class="text-md font-semibold mb-1">Movie <span class="text-red-600">*</span></label>
                <select name="movie" id="movie" class="bg-white w-full py-1" required>
                    <option  hidden>Choose movie</option>
                    <?php
                    // print each movie title as an option
                    while($movie = mysqli_fetch_assoc($movie_result)){
                        $attr="";
                        if($_SESSION['movie-title'] === $movie['movie_title'] && $_SESSION['schedule-edit']){
                            $attr = "selected";
                        }
                        echo "
                            <option class='py-1 ' value=".$movie['movie_id']." {$attr}> {$movie['movie_title']} </option>
                        ";
                    }
                    ?>
                </select>
            </div>
            <div class="flex flex-col items-start w-full">
                <label for="screen" class="text-md font-semibold mb-1">Screen <span class="text-red-600">*</span></label>
                <select name="screen" id="screen" class="bg-white w-full py-1 " required>
                    <option  hidden>Choose screen</option>
                    <?php
                    // print each screen name as an option
                    while($screen = mysqli_fetch_assoc($screen_result)){
                        $attr="";
                        if($_SESSION['screen-name'] === $screen['screen_name'] && $_SESSION['schedule-edit']){
                            $attr = "selected";
                        }
                        echo "
                            <option class='py-1 ' value=".$screen['screen_id']." {$attr}> {$screen['screen_name']} </option>
                        ";
                    }
                    ?>
                </select>
            </div>

            <!-- start time -->
            <div class="flex flex-col items-start">
                <label for="start" class="text-md font-semibold mb-1">Start <span class="text-red-600">*</span></label>
                <input id="start" type="datetime-local" name="start" class="py-1 border border-slate-200 w-full bg-white" value = "<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['start-time']) :"";   ?>" required>
            </div>

            <!-- end time -->
            <div class="flex flex-col items-start">
                <label for="end" class="text-md font-semibold mb-1">End <span class="text-red-600">*</span></label>
                <input id="end" type="datetime-local" class="py-1 border border-slate-200 w-full bg-white" name="end" value="<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['end-time']) :"";   ?>" required>
            </div>

            <!-- submit button -->
            <button class="bg-blue-950 text-white w-full p-2">Submit</button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['schedule-edit'] = false;
?>