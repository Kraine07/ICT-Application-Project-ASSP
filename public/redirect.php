<?php

    function redirect($page){

        $baseURL = 'http://127.0.0.1/backyard-cinema/public/';
        header("Location: {$baseURL}{$page}");
        die();

    }
?>