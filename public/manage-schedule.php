<?php

session_start();
date_default_timezone_set('America/Jamaica');
require_once('dbConn.php');
require_once('message-display.php');
require_once('./partials/head.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['movie'])){
        $conflict = false;
        $schedule_id = $_POST['schedule-id'];
        $movie = $_POST['movie'];
        $screen = $_POST['screen'];
        $start_date = dateToUnix($_POST['start']);
        $end_date = dateToUnix($_POST['end']);


        // check for scheduling conflicts
        $all_sql = "SELECT `schedule_id`, `screen`,`start`,`end` FROM `{$database}`.`{$schedule_table}` ";
        if($result = mysqli_query($conn,$all_sql)){
            while($row = mysqli_fetch_assoc($result)){
                if($row['screen'] == $screen && $row['schedule_id'] != $schedule_id &&
                (
                    (
                        $start_date <= $row['end'] &&
                        $start_date >= $row['start']
                    ) ||
                    (
                        $end_date <= $row['end'] &&
                        $end_date >= $row['start']
                    ) ||
                    (
                        $end_date >= $row['end'] &&
                        $start_date <= $row['end']
                    ) ||
                    (
                        $start_date >= $row['start'] &&
                        $end_date <= $row['start']
                    )
                )){
                    $conflict = true;
                }
            }


            if(!$conflict){
                // add or update schedule
                    $sql = "REPLACE INTO `{$database}`.`{$schedule_table}` VALUES(?,?,?,?,?)";
                    if(mysqli_execute_query($conn, $sql, [$schedule_id, $movie, $screen, $start_date, $end_date])){
                        $_SESSION['screen'] = 'schedule';
                        showSuccessMessage("Action completed successfully.");
                    }
                    else{
                        showErrorMessage("Error adding/updating schedule. Please try again or contact technical support.");
                    }
            }
            else{
                showErrorMessage("Scheduling conflict exists. Please adjust times or choose a different screen.");
            }
        }
    }

}



function dateToUnix($date_str){
$new_date = date_create($date_str);
return date_format($new_date,"U");
}


require_once('./partials/footer.php');

?>