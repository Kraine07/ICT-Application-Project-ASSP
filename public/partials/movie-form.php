<?php

$form_genres = [];
$cast = [];

$genres = "SELECT * FROM `{$database}`.`{$genre_table}`";


if($_SESSION['movie_form']){
    $form_movie = $_SESSION['form_movie'];
    $movie_genres = "SELECT * FROM `{$database}`.`{$has_genre_table}` WHERE `movie` = {$form_movie['movie_id']}";
    $cast_sql = "SELECT * FROM `{$database}`.`{$cast_table}` WHERE `movie` = {$form_movie['movie_id']}";

    // populate genres array with genre names
    if($movie_genres_result = mysqli_query($conn,$movie_genres)){
        while($genre_row = mysqli_fetch_assoc($movie_genres_result)){
            array_push($form_genres, $genre_row['genre']);
        }
    }

    // populate cast array with cast names
    if($cast_result = mysqli_query($conn, $cast_sql)){
        while($cast_row = mysqli_fetch_assoc($cast_result)){
            array_push($cast, $cast_row['cast_name']);
        }
    }
}

?>


<div class="w-screen h-screen absolute top-0 left-0 z-10 bg-app-modal <?php echo $_SESSION['movie_form'] ?'': 'hidden'; ?>  "  id="movie-form">
    <form action="manage-movie.php" method="post" class="flex flex-col items-center bg-app-tertiary h-auto w-[800px] pb-2 text-gray-200  absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-md    group" novalidate>

        <legend class="flex justify-between items-center bg-app-blue py-2 pl-8 pr-4 w-full text-2xl text-left rounded-t-md">
            <span>Edit Movie</span>
            <span class="inline-block cursor-pointer" id="close-movie-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
        </legend>

        <p class="text-md italic my-4 px-8 w-full text-left text-xs">Required fields <span class="text-app-orange">*</span></p>

        <div class="flex h-full w-full px-8 pb-6">
            <div class=" flex flex-col justify-between items-start h-full w-2/3 "  >
                <input type="text" name="form-movie-id" value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_id'] : '' ; ?> "  hidden>

                <!-- title -->
                <div class="flex flex-col items-start w-full">
                    <label for="title" class="  mb-1">Title<span class="text-app-orange ml-1">*</span></label>
                    <input  class="block w-full rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200 peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange peer " type="text" name="title" id="title" value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_title'] : '' ; ?> " required  pattern=".{2,}">

                    <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Empty fields not allowed.
                    </span>
                </div>

                <!-- cast -->
                <div class="grid grid-cols-3 gap-x-4 mt-3">

                    <?php
                        $index = 1;
                        foreach($cast as $c){
                            echo '
                            <div class="flex flex-col items-start">
                                <label for="cast1" class="mb-1 ">Cast #'.$index.'<span class="text-app-orange ml-1">*</span></label>
                                <input type="text" name="cast'.$index.'" id="cast1" class=" w-full rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200 peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange peer" value="'.$c.'"  required>
                                <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                                Empty fields not allowed.
                                </span>
                            </div>
                            ';
                            $index ++;
                        }
                    ?>
                </div>

                <!-- plot -->
                <div class="flex flex-col items-start w-full">
                    <label for="plot" class=" mt-3 mb-1" >Plot<span class="text-app-orange ml-1">*</span></label>
                    <textarea class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200 peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" name="plot" id="plot" cols="10" rows="2"  required><?php echo $_SESSION['movie_form']?$form_movie['movie_plot'] : '' ; ?></textarea>
                    <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Empty fields not allowed.
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-x-4">

                    <!-- duration -->
                    <div class="flex flex-col items-start">
                        <label for="duration" class=" mt-3 mb-1" >Duration (mins)<span class="text-app-orange ml-1">*</span></label>
                        <input class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200 peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" type="text" name="duration" id="duration"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_duration'] : '' ; ?> " required/>
                        <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Empty fields not allowed.
                        </span>
                    </div>

                    <!-- release date -->
                    <div class="flex flex-col items-start">
                        <label for="release" class=" mt-3 mb-1" >Release Date<span class="text-app-orange ml-1">*</span></label>
                        <input class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200 peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" type="date" name="release" id="release"  value= <?php echo $_SESSION['movie_form']?date("Y-m-d",$form_movie['movie_release_date']) : '' ; ?>  required/>
                        <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Invalid date.
                        </span>
                    </div>

                    <!-- rating -->
                    <div class="inline-flex flex-col items-start">
                        <label for="rating" class=" mt-3 mb-1" >Rating<span class="text-app-orange ml-1">*</span></label>
                        <input class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200  peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" type="text" name="rating" id="rating"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_rating'] : '' ; ?> " required>
                        <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                        Empty fields not allowed.
                        </span>
                    </div>

                </div>

                <!-- poster link -->
                <div class="flex flex-col items-start w-full">
                    <label for="poster" class=" mt-3 mb-1" >Poster URL<span class="text-app-orange ml-1">*</span></label>
                    <input class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200  peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" type="text" name="poster" id="poster"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_poster'] : '' ; ?> " required/>
                    <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Empty fields not allowed.
                    </span>
                </div>

                <!-- trailer link -->
                <div class="flex flex-col items-start w-full">
                    <label for="trailer" class=" mt-3 mb-1" >Trailer URL<span class="text-app-orange ml-1">*</span></label>
                    <input class=" rounded-sm text-app-blue  font-semibold  outline-none ring-0 px-2 py-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    border-2 border-gray-200 bg-gray-200  peer invalid:[&:not(:placeholder-shown):not(:focus)]:border-app-orange invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange w-full peer" type="text" name="trailer" id="trailer"  value=" <?php echo $_SESSION['movie_form']?$form_movie['movie_trailer'] : '' ; ?> " required/>
                    <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                    Empty fields not allowed.
                    </span>

                </div>
            </div>


            <div class="flex flex-col justify-between h-[match-parent] w-1/3  pl-8   ">
                <div>
                    <p class=" text-left mb-1">Genres<span class="text-app-orange ml-1">*</span></p>
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
                </div>

                <button class="mt-4 py-2 bg-app-blue text-app-orange text-lg hover:bg-blue-950 w-full rounded-md    group-invalid:pointer-events-none group-invalid:opacity-30">Submit</button>
            </div>
        </div>



    </form>
</div>

<?php
$_SESSION['movie_form'] = false;
?>