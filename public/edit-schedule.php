<?php

if(!isset($_SESSION)){
    session_start();
}

require_once('redirect.php');
require_once('dbConn.php');

function handleDeleteSchedule(){
    echo '
            <form action="edit-movie.php" method="post" id="cancel">
                <input type="text" name="cancel-delete" value="0" hidden>
            </form>
            <form action="edit-schedule.php" method="post" id="delete-form" class=" mt-4 pb-4 mx-auto px-6 w-[340px] shadow-custom text-sm">
                <p class="bg-red-600 text-white text-lg font-light -mx-6 px-6 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                WARNING
                </p>
                <input name="delete-id" type="text" value="'.$_POST['edit-id'].'" hidden>
                <input name="start" type="text" value="'.$_POST['start-time'].'" hidden>
                <input name="end" type="text" value="'.$_POST['end-time'].'" hidden>
                <p class="my-8"> Are you sure you want to delete schedule? This action is irreversible. </p>
                <div class="flex justify-around items-center">
                    <button form="delete-form" class="text-white bg-red-600 py-1 px-8 rounded-full">YES</button>
                    <button form="cancel" class="text-white bg-green-600  py-1 px-8 rounded-full">NO</button>
                </div>
            </form>
        ';

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['edit-id'])){
        require_once('./partials/head.php');

        // handle delete and edit button clicks
        switch($_POST['edit-option']){

            //  handle edit
            case 'edit':
                $_SESSION['schedule-edit'] = true;

                $_SESSION['movie-title'] = trim($_POST['movie-title']);
                $_SESSION['screen-name'] = trim($_POST['screen-name']);
                $_SESSION['schedule-id'] = trim($_POST['edit-id']);
                $_SESSION['start-time'] = trim($_POST['start-time']);
                $_SESSION['end-time'] = trim($_POST['end-time']);

                redirect('index.php');
                break;



            // handle delete
            case 'delete':
                handleDeleteSchedule();
                break;
        }
        require_once('./partials/footer.php');
    }
    elseif(isset($_POST['cancel-delete'])){
        redirect("index.php");
    }
    elseif(isset($_POST['delete-id'])){
        $delete_sql = "DELETE FROM `{$database}`.`{$schedule_table}` WHERE `schedule_id` = {$_POST['delete-id']} ";
        if(mysqli_query($conn,$delete_sql)){
            redirect("index.php");
        }
        else{
            showErrorMessage("Error deleting schedule. Please try again or contact technical support.");
        }


    }

}
?>