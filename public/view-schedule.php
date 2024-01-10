<?php
require_once('./partials/head.php');
echo "<div class='h-full w-full bg-blue-950'>";
require_once('./partials/navbar.php');

$day_names = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

$month_day = 1;  // day number to be displayed in calendar
$current_month = date('F'); // full text representation of a month
$days_in_month = date('t',strtotime($current_month)); // number of days in current month
$start_day =  date('w', strtotime( $current_month . ' 01,' . date('Y'))); // number representing the day that starts the month


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
                    $bg = ( $month_day == (int)date('j')) ? "bg-white text-gray-900" :"bg-gray-700";
                    if($i <= $start_day){
                        echo "<span></span>";
                    }else{
                        echo '
                        <form action="" method="post">
                            <input type="text" name="calendar-day" value="'.$month_day.'" hidden>
                            <button class="text-xs aspect-square text-light w-8 p-0 '. $bg .'  rounded-full">'.$month_day.'</button>
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

    </div>

</div>
<?php

require_once('./partials/footer.php');




?>