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
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-auto w-[300px] border-2 border-app-blue bg-app-tertiary rounded-md" >
        <h1 class="flex justify-between items-center text-gray-200 text-lg text-left bg-app-blue w-full pl-4 pr-2 py-2"><?php echo $_SESSION['schedule-edit']? "Edit": "New";?> Schedule
            <button class="p-0 m-0" id="close-schedule-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>
        <p class="text-xs text-left w-full  italic px-6  pt-2"> Required fields<span class="text-lg pl-1 text-app-orange">*</span> </p>

        <!-- schedule form -->
        <form action="manage-schedule.php" method="post" class="flex flex-col text-sm justify-between items-start w-full h-full px-6 pb-4  group" novalidate>
            <input type="text" name="schedule-id" value=" <?php echo $_SESSION['schedule-edit'] ? $_SESSION['schedule-id']:"";  ?>  " hidden>

            <!-- Select movie -->
            <div class="flex flex-col items-start w-full">
                <label for="movie" class="text-sm  mb-1 mt-2">Movie <span class="text-app-orange ml-1">*</span></label>
                <select name="movie" id="movie" class="bg-gray-200 text-app-blue rounded-sm w-full py-1  outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" required>
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
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">Select movie</span>
            </div>

            <!-- Select screen -->
            <div class="flex flex-col items-start w-full">
                <label for="screen" class="text-sm  mb-1 mt-2">Screen <span class="text-app-orange ml-1">*</span></label>
                <select name="screen" id="screen" class="bg-gray-200 text-app-blue rounded-sm   w-full py-1  outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange " required>
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
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">Select screen</span>
            </div>

            <!-- start time -->
            <div class="flex flex-col items-start w-full"  data-te-input-wrapper-init>
                <label for="schedule-start" class="text-sm  mb-1 mt-2">Start <span class="text-app-orange ml-1">*</span></label>
                <input id="schedule-start" type="text" name="start" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" value = "<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['start-time']) :"";   ?>" min="<?php echo date('Y-m-d\TH:i') ?>" placeholder="MM/DD/YYYY 00:00 AM" required>
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">Enter a valid start date</span>
            </div>

            <!-- end time -->
            <div class="flex flex-col items-start w-full">
                <label for="schedule-end" class="text-sm  mb-1 mt-2">End <span class="text-app-orange ml-1">*</span></label>
                <input id="schedule-end" type="text" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange " name="end" value="<?php  echo $_SESSION['schedule-edit']? date("Y-m-d H:i",$_SESSION['end-time']) :"";   ?>" min="<?php echo date('Y-m-d\TH:i') ?>" placeholder="MM/DD/YYYY 00:00 AM" required>
                <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">Enter a valid end date</span>
            </div>

            <!-- submit button -->
            <button class="bg-app-blue text-app-orange rounded-md hover:bg-blue-950 w-full my-4 py-2  group-invalid:pointer-events-none group-invalid:opacity-30"><?php  echo $_SESSION['schedule-edit']?"Update Schedule":"Create Schedule" ?></button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['schedule-edit'] = false;
?>