<?php

session_start();
require_once('dbConn.php');
require_once('./partials/head.php');
require_once('message-display.php');

require_once('api-handler.php');
require_once("redirect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // get all movies from api with full or partial match to title entered
    if(isset($_POST['search_movie'])){
        $query = preg_replace('/\s+/', '%20', $_POST['search_movie']); // replace all spaces with '%20' (api requirement)
        $search_movie = "https://api.themoviedb.org/3/search/movie?&include_adult=false&query={$query}";

        $response = fetchData($search_movie);

        if($response == null){
            showErrorMessage('No connection to source. Please try again or contact technical support.');
        }
        else{
            if(!isset($response->{'success'})){  // check if api call was successful
                $_SESSION['movie-search-results'] = $results = $response-> {'results'};

                $_SESSION['screen'] = "movie-result-list";
                redirect('index.php');

                }
            else{
                showErrorMessage($response->{'status_message'});
            }

        }
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
            showSuccessMessage("Movie added successfully.");
        }
    }
}



require_once('./partials/footer.php');
?>