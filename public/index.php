
<?php
session_start();

date_default_timezone_set('America/Jamaica');


// initialize session variables
if(!isset($_SESSION) || empty($_SESSION)){
    // user

    $_SESSION['screen'] = "main";
    $_SESSION['first-name'] = "";
    $_SESSION['last-name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['password'] = "";
    $_SESSION['c-password'] = "";
    $_SESSION['role'] = "";

    // screen
    $_SESSION['screen-1'] = "";
    $_SESSION['screen-2'] = "";
    $_SESSION['screen-3'] = "";
    $_SESSION['screen-4'] = "";
    $_SESSION['screen-name'] = "";

    $_SESSION['movie-search-results']="";

    $_SESSION['schedule-edit'] = false;

    $_SESSION['screen-id'] = "1";
    $_SESSION['movie-info'] = false;
    $_SESSION['watch-trailer'] = false;

}



require_once('dbConn.php');
require_once('redirect.php');
require_once('api-handler.php');

// create database if it has not yet been created
if($conn){
    $sql = "SHOW DATABASES WHERE `database` = '{$database}'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) < 1){
        $_SESSION['db-setup'] = 0;
        redirect('init.php');
    }
    else{
        $_SESSION['db-setup'] = 1;
    }
}


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


    // get movie data from api
    elseif(isset($_POST['movie-id'])){
        $movie_id = $_POST['movie-id'];
        $movie_url = "https://api.themoviedb.org/3/movie/{$movie_id}?append_to_response=release_dates,videos&language=en-US";
        $response = fetchData($movie_url);
        $release_dates = $response->{'release_dates'}->{'results'};
        $videos = $response->{'videos'}->{'results'};


        $title = $response->{'original_title'};
        $plot = $response->{'overview'};
        $duration = $response->{'runtime'};
        $poster = 'https://image.tmdb.org/t/p/original'.$response->{'poster_path'};
        $rating='';
        $trailer ='';
        $genres = $response->{'genres'};


        // rating
        foreach($release_dates as $rd){
            if($rd->{'iso_3166_1'} == 'US'){
                $rating = $rd->{'release_dates'}[0]->{'certification'};
            }
        }

        // trailer link
        foreach($videos as $video){
            $key = $video->{'key'};

            if($video->{'type'} == 'Trailer'){
                $trailer = 'https://www.youtube.com/embed/'.$key.'?autoplay=1&mute=0&controls=1';
                break;
            }

        }
        // display details
        require_once('./partials/movie-details.php');
    }


}




// handle page loading
require_once('./partials/head.php');
require_once('message-display.php');

    if(isset($_SESSION['auth-user'] )){
        require_once('./partials/admin-panel.php');
    }
    else{
        require_once('./partials/landing.php');
    }

require_once('./partials/footer.php');

?>