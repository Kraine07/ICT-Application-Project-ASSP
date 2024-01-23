<?php

    function redirect($page){
        $baseURL = 'http://127.0.0.1/backyard-cinema/public/';
        ob_start();
        header("Location: {$baseURL}{$page}");
        ob_end_flush();
        die();
    }

?>