<?php
session_start();
$_SESSION['patron-view'] = false;
require_once('dbConn.php');
require_once('redirect.php');
require_once('form-validation.php');
require_once('message-display.php');
include_once('./partials/head.php');


// check if a post was made
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // check if post is from login form
    if(isset($_POST['login'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);



        // validation
        if(emptyFields([$email,$password])){
            showErrorMessage('Empty fields now allowed. Please try again.');
        }
        else{
            if(validEmail($email)){
                if(validPassword($password)){

                    // hash password
                    $hPassword = hash("sha256",$password);
                    $cred = [$email,$hPassword];

                    // attempt login
                    login($cred,$conn,$database,$user_table);
                }
                else{
                    showErrorMessage('Invalid password format. Please ensure password contains at least 1 uppercase and numeral each and has a minimum of 8 characters.');
                }
            }
            else{
                showErrorMessage('Invalid email format. Please try again.');
            }
        }
    }
}



// handle login process
function login($credentials,$conn,$database,$user_table){

    $sql = "SELECT * FROM `{$database}`.`{$user_table}` WHERE `email` = ? and `password` = ? LIMIT 1";

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

        // USER LOGGED IN
        else{
            $_SESSION['screen'] = "movie";
            redirect('index.php');
        }

    }

}


require_once('./partials/footer.php');

?>