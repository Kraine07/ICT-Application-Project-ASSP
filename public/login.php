<?php
session_start();
require_once('dbConn.php');
require_once('redirect.php');
require_once('message-display.php');
include_once('./partials/head.php');


// check if a post was made
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // check if post is from login form
    if(isset($_POST['login'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hPassword = hash("sha256",$password);
        $cred = [$email,$hPassword];
        login($cred,$conn,$database,$user_table);
    }
}



// handle login process
function login($credentials,$conn,$database,$user_table){

    $sql = "SELECT * FROM `{$database}`.`{$user_table}` WHERE `email` = ? and `password` = ?";

    // check if query failed
    if(!$result = mysqli_execute_query($conn,$sql,$credentials)){
        showErrorMessage('Something went wrong. Please try again or contact technical support.','index');
        return false;
    }
    else{
        if(!$_SESSION['auth-user'] = mysqli_fetch_array($result)){

            // DISPLAY 'USER NOT AUTHORIZED' MESSAGE
            showErrorMessage('User not authorized. Please try again.','index');
            return false;
        }

        //USER LOGGED IN
        else{
            $_SESSION['screen'] = "movie";
            redirect('index.php');
        }

    }

}


require_once('./partials/footer.php');

?>