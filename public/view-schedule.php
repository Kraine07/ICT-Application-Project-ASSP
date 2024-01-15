<?php

session_start();

// initialize session variables
if(!isset($_SESSION['watch-trailer'])){
    $_SESSION['watch-trailer'] = false;
}
if(!isset($_SESSION['movie-info'])){
    $_SESSION['movie-info'] = false;
}

$_SESSION['patron-view'] = true;
$_SESSION['page'] = "view-schedule.php";

require_once('dbConn.php');
require_once('./partials/head.php');

// set default timezone
date_default_timezone_set('America/Jamaica');

// opening div tag
echo "<div class='h-full w-full bg-blue-950 overflow-y-auto'>";

require_once('./partials/navbar.php');
require_once('./partials/login-form-modal.php');


$day_names = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

$month_day = 1;  // day number to be displayed in calendar
$current_month = date('F'); // full text representation of a month
$days_in_month = date('t',strtotime($current_month)); // number of days in current month
$start_day =  date('w', strtotime( $current_month . ' 01,' . date('Y'))); // number representing the day that starts the month

// date selected by user (format  YYYY-MM-DD)
$selected_date = date('Y-m-d');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
$selected_date = date('Y-m-'.$_POST['calendar-day']);
}

$selected_day = date_format(date_create($selected_date),'j');

// get screen names
$screen_names = [];
$screen_sql = "SELECT * FROM `{$database}`.{$screen_table}";
if($result = mysqli_query($conn, $screen_sql)){
    while($row = mysqli_fetch_assoc($result))
        array_push($screen_names,$row['screen_name']);
}


$schedule_sql = "SELECT `movie_poster`, `movie_id`, `movie_title`,  `start`,  `movie`, `screen`, `screen_id`, `screen_name` FROM `{$database}`.`{$schedule_table}`, `{$database}`.`{$movie_table}`, `{$database}`.`{$screen_table}` WHERE `movie` = `movie_id` AND  `screen` = `screen_id` AND FROM_UNIXTIME(`start`,'%Y-%m-%d') = '$selected_date' ORDER BY `start`";

$new_date = date_create($selected_date);
$new_selected_date = date_format($new_date, 'F j, Y');



// sort result by screens
$cinema_1 = [];
$cinema_2 = [];
$cinema_3 = [];
$cinema_4 = [];

if($result = mysqli_query($conn, $schedule_sql)){
    while($row = mysqli_fetch_assoc($result)){
        if($row['screen'] == 1){
            array_push($cinema_1,$row);
        }
        elseif($row['screen'] == 2){
            array_push($cinema_2,$row);
        }
        elseif($row['screen'] == 3){
            array_push($cinema_3,$row);
        }
        elseif($row['screen'] == 4){
            array_push($cinema_4,$row);
        }

    }
}


?>

    <div class="flex items-center justify-between h-full w-full px-6">

        <!-- calendar -->
        <div class="h-auto w-[360px]  bg-gray-600   left-4 ">
            <div class="flex justify-around items-center text-white w-full py-2 mx-auto bg-gray-900">
                <!-- <span>&#10094;</span> -->
                <span class="text-2xl"><?php  echo $current_month;  ?></span>
                <!-- <span>&#10095;</span> -->

            </div>
            <div class="h-auto w-5/6 mx-auto py-4 text-white">
                <div class="grid grid-cols-7 gap-y-2 text-center justify-items-center">
                    <?php
                    // display day names
                    foreach($day_names as $day_name){
                        echo '
                        <span class=" aspect-square text-bold ">'.$day_name.'</span>
                        ';
                    }

                    // display calendar days
                    for($i=1; $i<=$days_in_month+$start_day; $i++){
                        $css_class = ( $selected_day == $month_day) ? "text-black rounded-full bg-yellow-500 " :"";
                        if($i <= $start_day){
                            echo "<span></span>";
                        }else{
                            echo '
                            <form action="view-schedule.php" method="post" class="font-medium">
                                <input type="text" name="calendar-day" value="'.sprintf("%02d",$month_day).'" hidden>
                                <button class="text-sm aspect-square  w-6 p-0 '. $css_class .'  ">'.$month_day.'</button>
                            </form>
                        ';
                        $month_day ++;
                        }

                    }
                    ?>

                </div>

            </div>
        </div>


        <!-- display schedules -->
        <div class="w-[840px] h-full   overflow-y-auto p-4">

            <div class="mx-auto h-full">
                <span class='text-4xl font-light text-white block pb-4  text-right'> <?php echo $new_selected_date; ?> </span>
                <div class=" mx-auto h-3/4">

                <!-- Tabs (screen names) -->
                    <input type="radio" id="tab1" name="tab" class="hidden " checked>
                    <label for="tab1" class="cursor-pointer bg-slate-500 text-white  px-8 inline-block" > <?php  echo $screen_names[0];  ?> </label>

                    <input type="radio" id="tab2" name="tab" class="hidden">
                    <label for="tab2" class="cursor-pointer bg-slate-500 text-white  px-8 inline-block"> <?php  echo $screen_names[1];  ?> </label>

                    <input type="radio" id="tab3" name="tab" class="hidden">
                    <label for="tab3" class="cursor-pointer bg-slate-500 text-white  px-8 inline-block"> <?php  echo $screen_names[2];  ?> </label>

                    <input type="radio" id="tab4" name="tab" class="hidden">
                    <label for="tab4" class="cursor-pointer bg-slate-500 text-white  px-8 inline-block"> <?php  echo $screen_names[3];  ?> </label>


                    <!-- Tab Content 1 -->
                    <div id="tab-content-1" class="tab-content h-full  border-t-2 border-white py-12">
                        <div class=" grid grid-cols-4 gap-6 h-auto">

                        <?php
                            foreach($cinema_1 as $row){
                                require('./partials/movie-card.php');
                            }
                        ?>
                        </div>
                    </div>


                    <!-- Tab Content 2 -->
                    <div id="tab-content-2" class="hidden tab-content h-full border-t-2 border-white py-12">
                        <div class="grid grid-cols-4 gap-6 h-auto">

                        <?php
                            foreach($cinema_2 as $row){
                                require('./partials/movie-card.php');
                            }
                        ?>
                        </div>
                    </div>


                    <!-- Tab Content 3 -->
                    <div id="tab-content-3" class="hidden tab-content h-full border-t-2 border-white py-12">
                        <div class="grid grid-cols-4 gap-6 h-auto">

                        <?php
                            foreach($cinema_3 as $row){
                                require('./partials/movie-card.php');
                            }
                        ?>
                        </div>
                    </div>


                    <!-- Tab Content 4 -->
                    <div id="tab-content-4" class="hidden tab-content h-full border-t-2 border-white py-12">
                        <div class="grid grid-cols-4 gap-6 h-auto">

                        <?php
                            foreach($cinema_4 as $row){
                                require('./partials/movie-card.php');
                            }
                        ?>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
<?php
require_once('./partials/movie-info-modal.php');
require_once('./partials/watch-trailer.php');
require_once('./partials/footer.php');
?>
</div>
