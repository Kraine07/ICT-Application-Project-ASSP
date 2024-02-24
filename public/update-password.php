<?php

session_start();

require_once('form-validation.php');
require_once('message-display.php');
require_once('dbConn.php');

require_once('./partials/head.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $old_password = $_POST['old-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];
    $hash_password = hash("sha256",$new_password);


    // check for correct current password
    if(hash('sha256',$old_password) != $_SESSION['auth-user']['password']){
        showErrorMessage('Old password is not correct. Please try again.');
    }

    // verify new passwords match
    else if(!checkForDuplicates([$new_password,$confirm_password])){
        showErrorMessage('New passwords do not match. Please try again.');

    }
    // verify old and new passwords are different
    else if(checkForDuplicates([$old_password,$new_password])){
        showErrorMessage('New password is similar to old password. Please try again.');
    }


    else{
        $sql = "UPDATE `{$database}`.`{$user_table}` SET `password` = ? WHERE `user_id` = {$_SESSION['auth-user']['user_id']}";
        if(mysqli_execute_query($conn,$sql,[$hash_password])){
            session_destroy();
            showSuccessMessage('Password successfully updated. Please login using the new password.');
        }
    }



}

require_once('./partials/footer.php');

?>