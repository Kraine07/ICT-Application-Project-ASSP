<?php
require_once('dbConn.php');
require_once('./partials/head.php');
echo "<div class='h-full w-full bg-blue-950'>";
require_once('./partials/navbar.php');

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

$schedule_sql = "SELECT `movie_poster`, `movie_id`, `movie_title`, `movie_plot`, `movie_duration`,`movie_trailer`, `start`, `end`, `movie`, `screen` FROM `{$database}`.`{$schedule_table}`, `{$database}`.`{$movie_table}`, `{$database}`.`{$screen_table}` WHERE `movie` = `movie_id` AND  `screen` = `screen_id` AND FROM_UNIXTIME(`start`,'%Y-%m-%d') = '$selected_date' ORDER BY `start`";


?>

    <!-- calendar -->
    <div class="h-auto w-[360px]  bg-gray-600  top-1/2 -translate-y-1/2 absolute left-4 ">
        <div class="flex justify-around items-center text-white w-full py-2 mx-auto bg-gray-900">
            <!-- <span>&#10094;</span> -->
            <span class="text-2xl"><?php echo $current_month;  ?></span>
            <!-- <span>&#10095;</span> -->

        </div>
        <div class="h-auto w-5/6 mx-auto py-4 text-white">
            <div class="grid grid-cols-7 gap-y-2 text-center justify-items-center">
                <?php
                // display day names
                foreach($day_names as $day_name){
                    echo '
                    <span class=" aspect-square text-bold text-white ">'.$day_name.'</span>
                    ';
                }

                // display calendar days
                for($i=1; $i<=$days_in_month+$start_day; $i++){
                    $border = ( $month_day == (int)date('j')) ? "border border-white" :"";
                    if($i <= $start_day){
                        echo "<span></span>";
                    }else{
                        echo '
                        <form action="view-schedule.php" method="post">
                            <input type="text" name="calendar-day" value="'.sprintf("%02d",$month_day).'" hidden>
                            <button class="text-xs aspect-square text-light w-8 p-0 '. $border .'  rounded-full">'.$month_day.'</button>
                        </form>
                    ';
                    $month_day ++;
                    }

                }
                ?>

            </div>

        </div>
    </div>


    <!-- schedule views -->
    <div class="w-[840px] h-full bg-slate-700 right-4 absolute overflow-y-auto">
        <?php
        $new_date = date_create($selected_date);
        $new_selected_date = date_format($new_date, 'F j, Y');
        echo "<span class='text-xl font-bold block'> {$new_selected_date} </span>";
        if($result = mysqli_query($conn, $schedule_sql)){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['movie_title']."<br>";
            }

        }
        ?>
    </div>

</div>
<?php

require_once('./partials/footer.php');




?>