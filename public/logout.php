<?php
session_start();
require_once('redirect.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    session_destroy();
    redirect('index.php');
}

?>