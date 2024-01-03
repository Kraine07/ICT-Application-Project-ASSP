
<?php
session_start();
// session_destroy();


// initialize session variables
if(!isset($_SESSION) || empty($_SESSION)){
    // user
    $_SESSION['db-setup'] = 0;

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

}

require_once('api-handler.php');

require_once('dbConn.php');
require_once('redirect.php');

// create database if it has not yet been created
if($conn){
    $sql = "SHOW DATABASES WHERE `database` = '{$database}'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) < 1){
        redirect('init.php');
    }
    else{
        $_SESSION['db-setup'] = 1;
    }
}


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

    // POST from search movie title modal
    elseif(isset($_POST['search_movie'])){
        $query = trim($_POST['search_movie']);
        $search_movie = "https://api.themoviedb.org/3/search/movie?&include_adult=false&query={$query}";

        $response = fetchData($search_movie);

        if($response == null){
            showErrorMessage('No connection to source. Please try again or contact technical support.');
        }
        else{
            if(!isset($response->{'success'})){  // check if api call was successful
                $_SESSION['movie-search-results'] = $results = $response-> {'results'};

                $_SESSION['screen'] = "movie-result-list";

                }
            else{
                showErrorMessage($response->{'status_message'});
            }

        }
    }

    // get movie data from api using selected movie id
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
                $trailer = 'https://www.youtube.com/embed/'.$key.'?autoplay=1&mute=1&controls=1';
                break;
            }


        }
        // display details
        require_once('movie-details.php');
    }

    // add movie
    elseif(isset($_POST['movie-details'])){
        $sql = "INSERT INTO `{$database}`.`{$movie_table}` VALUES (?,?,?,?,?,?,?)";
        $movie = [
            $_SESSION['movie-id'],
            $_SESSION['title'],
            $_SESSION['plot'],
            $_SESSION['duration'],
            $_SESSION['poster'],
            $_SESSION['trailer'],
            $_SESSION['rating'] == "" ? "NR" : $_SESSION['rating']
        ];
        // add movie to database
        if(!mysqli_execute_query($conn,$sql,$movie)){
            showErrorMessage("Error adding movie. Please try again or contact technical support.");
        }
        else{
            // add genres to database
            foreach($_SESSION['genres'] as $genre){
                $genre_sql = "INSERT INTO `{$database}`.`{$has_genre_table}` VALUES (?,?)";
                if(!mysqli_execute_query($conn,$genre_sql,[$_SESSION['movie-id'], $genre->{'id'}])){
                    showErrorMessage("Error adding movie genres. Please try again or contact technical support.");
                }
            }
            // return to movies main screen
            $_SESSION['screen'] = "movie";
        }
    }

    // SCHEDULE
    elseif(isset($_POST['movie'])){
        $conflict = false;
        $schedule_id = $_POST['schedule-id'];
        $movie = $_POST['movie'];
        $screen = $_POST['screen'];
        $start_date = dateToUnix($_POST['start']);
        $end_date = dateToUnix($_POST['end']);


        // check for scheduling conflicts
        $all_sql = "SELECT `schedule_id`, `screen`,`start`,`end` FROM `{$database}`.`{$schedule_table}` ";
        if($result = mysqli_query($conn,$all_sql)){
            while($row = mysqli_fetch_assoc($result)){
                if($row['screen'] == $screen && $row['schedule_id'] != $schedule_id && (($start_date <= $row['end'] && $start_date >= $row['start']) || ($end_date <= $row['end'] && $end_date >= $row['start']))){
                    $conflict = true;
                }
            }


            if(!$conflict){
                // add or update schedule
                    $sql = "REPLACE INTO `{$database}`.`{$schedule_table}` VALUES(?,?,?,?,?)";
                    if(mysqli_execute_query($conn, $sql, [$schedule_id, $movie, $screen, $start_date, $end_date])){
                        $_SESSION['screen'] = 'schedule';
                    }
                    else{
                        showErrorMessage("Error adding/updating movie. Please try again or contact technical support.");
                    }
            }
            else{
                showErrorMessage("Scheduling conflict exists. Please adjust times or choose a different screen.");
            }
        }
    }

}

function dateToUnix($date_str){
    $new_date = date_create($date_str);
    return date_format($new_date,"U");
}




// handle page loading
require_once('./partials/head.php');
require_once('error-handler.php');

    if(isset($_SESSION['auth-user'] )){
        require_once('./partials/admin-panel.php');
    }
    else{
        require_once('./partials/landing.php');
    }

require_once('./partials/footer.php');

?>