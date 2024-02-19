
<?php
session_start();

date_default_timezone_set('America/Jamaica');


// initialize session variables
if(!isset($_SESSION['auth-user']) || !isset($_SESSION['movie-search-results'])){


    $_SESSION['screen'] = "main";
    $_SESSION['first-name'] = "";
    $_SESSION['last-name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['password'] = "";
    $_SESSION['c-password'] = "";
    $_SESSION['role'] = "";

    $_SESSION['screen-1'] = "";
    $_SESSION['screen-2'] = "";
    $_SESSION['screen-3'] = "";
    $_SESSION['screen-4'] = "";
    $_SESSION['screen-name'] = "";
    $_SESSION['movie-title'] = "";

    $_SESSION['movie-search-results']=[];

    $_SESSION['schedule-edit'] = false;
    $_SESSION['user-edit'] = false;
    $_SESSION['movie_form'] = false;
    $_SESSION['form_movie'] = [];

}

$_SESSION['watch-trailer'] = false;
$_SESSION['patron-view'] = false;




require_once('dbConn.php');
require_once('redirect.php');
require_once('api-handler.php');



// handle posts
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // menu buttons
    if(isset($_POST['manage-movies'])){
        $_SESSION['screen'] = "movie";
    }
    elseif(isset($_POST['manage-schedules'])){
        $_SESSION['screen'] = "schedule";
    }
    elseif(isset($_POST['manage-users'])){
        $_SESSION['screen'] = "user";
    }


    

}

// handle page loading
require_once('./partials/head.php');
require_once('message-display.php');

    if(isset($_SESSION['auth-user'])){
        require_once('./partials/admin-panel.php');
    }
    else{
        require_once('./partials/landing.php');
    }

require_once('./partials/footer.php');

?>