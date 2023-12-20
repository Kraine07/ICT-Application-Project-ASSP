<?php
session_start();
require_once('dbConn.php');
require_once('redirect.php');
include_once('error-handler.php');


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

    if($conn){ // check for database connection
        $result = mysqli_execute_query($conn,$sql,$credentials);

        if($result === false){ // check if query failed
            showErrorMessage('Something went wrong. Please try again or contact technical support.','index');
            return false;
        }
        else{
            if(!mysqli_fetch_array($result)){

                // DISPLAY 'USER NOT AUTHORIZED' MESSAGE
                showErrorMessage('User not authorized. Please try again.','index');
                return false;

                // DEPRECATE LOGIN ATTEMPTS

                // IF ATTEMPTS == 0, SUSPEND LOGIN FUNCTIONALITY

            }else{

                //USER LOGGED IN
                $_SESSION['auth-user'] = true;
                redirect('index.php');

                // RESET LOGIN ATTEMPTS

            }

        }
    }



}




?>