<?php
if(!isset($_SESSION)){
    session_start();
}

$movie_sql = "SELECT `movie_id`,`movie_title` FROM `{$database}`.`{$movie_table}` ORDER BY `movie_title`";
if(!$movie_result = mysqli_query($conn, $movie_sql)){
    showErrorMessage("Error retrieving movies. Please try again or contact technical support.");
}

$screen_sql = "SELECT * FROM `{$database}`.`{$screen_table}`";
if(!$screen_result = mysqli_query($conn, $screen_sql)){
    showErrorMessage("Error retrieving screens. Please try again or contact technical support.");
}


?>


<!--  Schedule form modal window -->
<div id="schedule-form" class="absolute top-0 left-0 bg-app-modal  w-full h-full z-10    <?php echo $_SESSION['schedule-edit'] ? "": "hidden" ?>   " >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[400px] w-[300px] border-2 border-app-blue bg-app-tertiary" >
        <h1 class="flex justify-between items-center text-gray-200 text-lg text-left bg-app-blue w-full px-4 py-2"><?php echo $_SESSION['schedule-edit']? "Edit": "New";?> Schedule
            <button class="p-0 m-0" id="close-schedule-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>
        <p class="text-xs text-left w-full  italic px-6  pt-2"> Required fields<span class="text-lg pl-1 text-app-orange">*</span> </p>
        <!-- schedule form -->
        <form action="manage-schedule.php" method="post" class="flex flex-col justify-between items-start w-full h-full px-6 pb-4">
            <input type="text" name="schedule-id" value=" <?php echo $_SESSION['schedule-edit'] ? $_SESSION['schedule-id']:"";  ?>  " hidden>
            <div class="flex flex-col items-start w-full">
                <label for="movie" class="text-md font-semibold mb-1 mt-2">Movie <span class="text-app-orange">*</span></label>
                <select name="movie" id="movie" class="bg-gray-200 text-app-blue rounded-md px-2 w-full py-1" required>
                    <option value="" hidden>Choose movie</option>
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
                <label for="screen" class="text-md font-semibold mb-1 mt-2">Screen <span class="text-app-orange">*</span></label>
                <select name="screen" id="screen" class="bg-gray-200 text-app-blue rounded-md px-2  w-full py-1 " required>
                    <option value="" hidden>Choose screen</option>
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
                <label for="start" class="text-md font-semibold mb-1 mt-2">Start <span class="text-app-orange">*</span></label>
                <input id="start" type="datetime-local" name="start" class="py-1 px-2 rounded-md w-full bg-gray-200 text-app-blue " value = "<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['start-time']) :"";   ?>" min="<?php echo $_SESSION['schedule-edit']?'': date('Y-m-d\TH:i'); ?>" required>
            </div>

            <!-- end time -->
            <div class="flex flex-col items-start">
                <label for="end" class="text-md font-semibold mb-1 mt-2">End <span class="text-app-orange">*</span></label>
                <input id="end" type="datetime-local" class="py-1 px-2 rounded-md w-full bg-gray-200 text-app-blue " name="end" value="<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['end-time']) :"";   ?>" min="<?php echo date('Y-m-d\TH:i') ?>" required>
            </div>

            <!-- submit button -->
            <button class="bg-app-blue text-app-orange rounded-md uppercase  w-full my-4 py-1">Submit</button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['schedule-edit'] = false;
?>