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

        login($email,$password,$conn);
        redirect('index.php');
    }
}



// handle login process
function login($email,$password,$conn){
    $sql = "SELECT * FROM `user` WHERE `email` = ? and `password` = ?";

    if($conn){ // check for database connection
        resetErrorMessage();
        $result = mysqli_execute_query($conn,$sql,[$email,$password]);

        if($result === false){ // check if query failed
            showErrorMessage('Something went wrong. Please try again');
        }
        else{
            resetErrorMessage();
            if(!mysqli_fetch_array($result)){

                // DISPLAY 'USER NOT AUTHORIZED' MESSAGE
                showErrorMessage('User not authorized');

                // DEPRECATE LOGIN ATTEMPTS

                // IF ATTEMPTS == 0, SUSPEND LOGIN FUNCTIONALITY

            }else{

                //USER LOGGED IN
                resetErrorMessage();
                redirect('admin-panel.php');
                // RESET LOGIN ATTEMPTS

            }

        }
    }
    else{
        showErrorMessage('Database connection error. Please try again or contact system administrator.');
    }



}




?>