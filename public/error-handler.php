<?php

    function showErrorMessage($message){
        $_SESSION['error'] = true;
        $_SESSION['err-message'] = $message;
    }


    function resetErrorMessage(){
        $_SESSION['error'] = false;
        $_SESSION['err-message'] = "";
    }

?>