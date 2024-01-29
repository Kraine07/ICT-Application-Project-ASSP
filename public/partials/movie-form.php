<?php

$genres = "SELECT * FROM `{$database}`.`{$genre_table}`";

$form_genres = [];
if($_SESSION['movie_form']){
    $form_movie = $_SESSION['form_movie'];

    $movie_genres = "SELECT * FROM `{$database}`.`{$has_genre_table}` WHERE `movie` = {$form_movie['movie_id']}";
    if($movie_genres_result = mysqli_query($conn,$movie_genres)){
        while($genre_row = mysqli_fetch_assoc($movie_genres_result)){
            array_push($form_genres, $genre_row['genre']);
        }
    }
}

?>


<div class="w-screen h-screen absolute top-0 left-0 z-10 bg-app-modal <?php echo $_SESSION['movie_form'] ?'': 'hidden'; ?>  "  id="movie-form">
    <form action="manage-movie.php" method="post" class="flex flex-col items-center bg-app-tertiary h-4/5 w-3/5 pb-6 text-gray-200  absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">

        <legend class="flex justify-between items-center bg-app-blue py-2 px-8 w-full text-2xl text-left">
            <span>Edit Movie</span>
            <span class="inline-block cursor-pointer" id="close-movie-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
        </legend>

        <p class="text-md italic mt-2">Required fields <span class="text-app-orange">*</span></p>

        <div class="flex h-4/5 w-full px-8 pb-6">
            <div class=" flex flex-col justify-between items-start h-full w-2/3 "  >
                <input type="text" name="form-movie-id" value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_id'] : '' ; ?> "  hidden>

                <!-- title -->
                <div class="flex flex-col items-start w-full">
                    <label for="title" class="  mb-1">Title<span class="text-app-orange">*</span></label>
                    <input  class="text-app-blue font-semibold  w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" type="text" name="title" id="title" value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_title'] : '' ; ?> " required/>
                </div>

                <!-- plot -->
                <div class="flex flex-col items-start w-full">
                    <label for="plot" class=" mt-3 mb-1" >Plot<span class="text-app-orange">*</span></label>
                    <textarea class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" name="plot" id="plot" cols="10" rows="4"  required><?php echo $_SESSION['movie_form']?$form_movie['movie_plot'] : '' ; ?></textarea>
                </div>

                <div class="flex justify-between w-full">

                    <!-- duration -->
                    <div class="flex flex-col items-start w-2/5">
                        <label for="duration" class=" mt-3 mb-1" >Duration (mins)<span class="text-app-orange">*</span></label>
                        <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" type="text" name="duration" id="duration"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_duration'] : '' ; ?> " required/>
                    </div>

                    <!-- rating -->
                    <div class="inline-flex flex-col items-start w-2/5">
                        <label for="rating" class=" mt-3 mb-1" >Rating<span class="text-app-orange">*</span></label>
                        <input class="text-app-blue font-semibold  w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" type="text" name="rating" id="rating"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_rating'] : '' ; ?> " required/>
                    </div>

                </div>

                <!-- poster link -->
                <div class="flex flex-col items-start w-full">
                    <label for="poster" class=" mt-3 mb-1" >Poster URL<span class="text-app-orange">*</span></label>
                    <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" type="text" name="poster" id="poster"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_poster'] : '' ; ?> " required/>
                </div>

                <!-- trailer link -->
                <div class="flex flex-col items-start w-full">
                    <label for="trailer" class=" mt-3 mb-1" >Trailer URL<span class="text-app-orange">*</span></label>
                    <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue px-1 py-[2px]" type="text" name="trailer" id="trailer"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_trailer'] : '' ; ?> " required/>

                </div>
            </div>


            <div class="flex flex-col justify-between h-full w-1/3  pl-8 ">
                <p class=" text-left mb-4">Genres<span class="text-app-orange">*</span></p>
                <div class="grid grid-cols-2 gap-y-3 text-xs">


                    <?php

                        if($genres_result = mysqli_query($conn,$genres)){

                            // display list of genres
                            while($row = mysqli_fetch_array($genres_result)){
                                $checked = (in_array($row['genre_id'], $form_genres) ) ? 'checked' : '';
                                echo "
                                <div class='flex'>
                                    <input type='checkbox' name='genres[]' id='{$row['genre_id']}' value='{$row['genre_id']}' {$checked}  >
                                    <label class='ml-1' for='{$row['genre_id']}'>{$row['genre_name']}</label>
                                </div>
                                ";
                            }
                        }
                    ?>

                </div>
                <button class="mt-4 py-1 bg-app-blue text-app-orange w-full rounded-full">Submit</button>
            </div>
        </div>



    </form>
</div>

<?php
$_SESSION['movie_form'] = false;
?>