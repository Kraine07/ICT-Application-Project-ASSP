<?php
// turn off error reports
// error_reporting(E_ERROR | E_PARSE);

include('./partials/head.php');

function showErrorMessage($message, $redirect){
    echo '
    <div class="h-screen w-screen bg-slate-400">
        <div class="w-80 rounded-lg bg-white  absolute z-30 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 border-red-500 border">
            <h2 class="text-lg bg-red-500 text-white p-2 font-bold">Error</h2>
            <span class=" text-sm m-2  block">'. $message . ' </span>
            <a href="'.$redirect.'.php" class="text-sm text-white text-center font-semibold float-right cursor-pointer m-2 bg-red-500 py-1 w-20 rounded-full">OK</a>
        </div>
    </div>

    ';

}

function handleError($errno, $errstr) {
    // echo "<b>Error from custom:</b> [$errno] $errstr";
    showErrorMessage($errstr,'index');
    die();
}
set_error_handler('handleError');

?>