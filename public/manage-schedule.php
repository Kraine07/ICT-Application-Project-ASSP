<?php

session_start();
$_SESSION['patron-view'] = false;


date_default_timezone_set('America/Jamaica');

require_once('dbConn.php');
require_once('./partials/head.php');
require_once('message-display.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['movie'])){
        $conflict = false;
        $schedule_id = $_POST['schedule-id'];
        $movie = $_POST['movie'];
        $screen = $_POST['screen'];
        $start_date = dateToUnix($_POST['start']);
        $end_date = dateToUnix($_POST['end']);


        // check for scheduling conflicts
        $all_schedules_sql = "SELECT `schedule_id`, `screen`,`start`,`end` FROM `{$database}`.`{$schedule_table}` ";
        if($result = mysqli_query($conn,$all_schedules_sql)){
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
                // CHECK IF SCHEDULE IS SHORTER THAN MOVIE DURATION
                $movie_duration_sql = "SELECT `movie_duration` FROM `{$database}`.`{$movie_table}` WHERE `movie_id` = $movie";
                if($result = mysqli_query($conn, $movie_duration_sql)){
                    while($row = mysqli_fetch_assoc($result)){
                        $duration = gmdate("g\h\\r i\m\i\\n", ($row['movie_duration']*60));
                        if(($end_date - $start_date) < ($row['movie_duration'] * 60)){
                            showErrorMessage("Schedule period is shorter than movie duration. Schedule needs to be at least {$duration} long.");
                        }
                        else{
                            // add or update schedule
                            $sql = "REPLACE INTO `{$database}`.`{$schedule_table}` VALUES(?,?,?,?,?,?)";
                            if(mysqli_execute_query($conn, $sql, [$schedule_id, $movie, $screen, $_SESSION['auth-user']['user_id'], $start_date, $end_date])){
                                $_SESSION['screen'] = 'schedule';
                                showSuccessMessage("Action completed successfully.");
                            }
                            else{
                                showErrorMessage("Error adding/updating schedule. Please try again or contact technical support.");
                            }
                        }
                    }
                }
            }
            else{
                showErrorMessage("Scheduling conflict exists. Please adjust times or choose a different screen.");
            }
        }
    }




    elseif(isset($_POST['edit-id'])){

        // handle delete and edit button clicks
        switch($_POST['edit-option']){

            //  handle edit
            case 'edit':
                $_SESSION['movie-title'] = trim($_POST['movie-title']);
                $_SESSION['screen-name'] = trim($_POST['screen-name']);
                $_SESSION['schedule-id'] = trim($_POST['edit-id']);
                $_SESSION['start-time'] = trim($_POST['start-time']);
                $_SESSION['end-time'] = trim($_POST['end-time']);
                $_SESSION['schedule-edit'] = true;
                $_SESSION['screen'] = 'schedule';
                redirect('index.php');
                break;

            // handle delete
            case 'delete':
                handleDeleteSchedule();
                break;
        }
    }


    //cancel delete
    elseif(isset($_POST['cancel-delete'])){
        $_SESSION['screen'] = 'schedule';
        redirect("index.php");
    }

    // confirm delete
    elseif(isset($_POST['delete-id'])){
        $delete_sql = "DELETE FROM `{$database}`.`{$schedule_table}` WHERE `schedule_id` = {$_POST['delete-id']} ";
        if(mysqli_query($conn,$delete_sql)){
            showSuccessMessage('Schedule deleted successfully.');
        }
        else{
            showErrorMessage("Error deleting schedule. Please try again or contact technical support.");
        }


    }
}





function dateToUnix($date_str){
$new_date = date_create($date_str);
return date_format($new_date,"U");
}


function handleDeleteSchedule(){
    echo '
        <div class="absolute top-0 left-0 h-screen w-screen bg-app-modal">
            <form action="manage-schedule.php" method="post" id="cancel">
                <input type="text" name="cancel-delete" value="0" hidden>
            </form>
            <form action="manage-schedule.php" method="post" id="delete-form" class=" bg-app-tertiary text-gray-200 absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2 pb-4  px-6 w-[340px] text-sm">
                <p class="bg-app-blue text-app-orange text-lg font-light -mx-6 px-6 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    <span>WARNING</span>
                </p>
                <input name="delete-id" type="text" value="'.$_POST['edit-id'].'" hidden>
                <input name="start" type="text" value="'.$_POST['start-time'].'" hidden>
                <input name="end" type="text" value="'.$_POST['end-time'].'" hidden>
                <p class="my-8"> Are you sure you want to delete schedule? This action is irreversible. </p>
                <div class="flex justify-around items-center">
                    <button form="delete-form" class=" bg-red-600 py-1 px-8 rounded-full">YES</button>
                    <button form="cancel" class=" bg-green-600  py-1 px-8 rounded-full">NO</button>
                </div>
            </form>
    
        </div>
        ';

}
require_once('./partials/footer.php');

?>