
<?php
session_start();
// session_destroy();



// initialize session variables
if($_SESSION == null){
    // user
    $_SESSION['db-setup'] = false;
    $_SESSION['auth-user'] = false;
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

}

require_once('api-handler.php');
require_once('error-handler.php');
require_once('dbConn.php');
require_once('redirect.php');

// create database if it has not yet been created
if($conn){
    $sql = "SHOW DATABASES WHERE `database` = '{$database}'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) < 1){
        redirect('setup.php');
    }
    else{
        $_SESSION['db-setup'] = true;
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['manage-movies'])){
        $_SESSION['screen'] = "movie";
    }
    elseif(isset($_POST['manage-schedules'])){
        $_SESSION['screen'] = "schedule";
    }
    elseif(isset($_POST['manage-users'])){
        $_SESSION['screen'] = "user";
    }
    elseif(isset($_POST['search_movie'])){ // POST from search movie title modal (partials/admin-panel.php)
        $query = trim($_POST['search_movie']);
        $search_movie = "https://api.themoviedb.org/3/search/movie?&include_adult=false&query={$query}";

        $response = fetchData($search_movie);

        if($response == null){
            showErrorMessage('No connection to source. Please try again or contact technical support.','index');
        }
        else{
            if(!isset($response->{'success'})){  // check if api call was successful
                $_SESSION['movie-search-results'] = $results = $response-> {'results'};

                $_SESSION['screen'] = "movie-result-list";

                }
            else{
                showErrorMessage($response->{'status_message'},'index');
            }

        }
    }
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

            if($video->{'type'} === 'Trailer'){
                $trailer = 'https://www.youtube.com/embed/'.$key.'?autoplay=1&mute=1&controls=1';
                break;
            }


        }
        // display details
        require_once('movie-details.php');
    }
    elseif(isset($_POST['movie-details'])){
        // TODO handle mysql errors
        $sql = "INSERT INTO `{$database}`.`{$movie_table}` VALUES (?,?,?,?,?,?,?)";
        // add movie to database
        $result = mysqli_execute_query($conn,$sql,[
            $_SESSION['movie-id'],
            $_SESSION['title'],
            $_SESSION['plot'],
            $_SESSION['duration'],
            $_SESSION['poster'],
            $_SESSION['trailer'],
            $_SESSION['rating'] == "" ? "NR" : $_SESSION['rating']
        ]);
        // add genres to database
        foreach($_SESSION['genres'] as $genre){
            $genre_sql = "INSERT INTO `{$database}`.`{$has_genre_table}` VALUES (?,?)";
            $result = mysqli_execute_query($conn,$genre_sql,[
                $_SESSION['movie-id'],
                $genre->{'id'}
        ]);
        }
        // return to movies main screen
        $_SESSION['screen'] = "movie";
    }
}





// handle page loading
require_once('./partials/head.php');

if($_SESSION['auth-user'] == false){
    require_once('./partials/landing.php');
}
else{
    require_once('./partials/admin-panel.php');
}

require_once('./partials/footer.php');

?>