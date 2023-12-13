<?php
    $_SESSION['movie-id'] = $movie_id;
    $_SESSION['title'] = $title;
    $_SESSION['plot'] = $plot;
    $_SESSION['rating'] = $rating;
    $_SESSION['poster'] = $poster;
    $_SESSION['trailer'] = $trailer;
    $_SESSION['duration'] = $duration;
    $_SESSION['genres'] = $genres;
?>

<div class="absolute w-screen h-screen  p-12 bg-slate-300">


    <div class="flex justify-between">
        <div class="w-1/4">
            <img class="w-full object-contain mx-auto" src=<?php echo $poster; ?> >
        </div>
        <div class="w-3/5 text-slate-700">
            <div class="flex justify-between items-start mb-4">
                <span class="text-4xl font-light"> <?php echo $title;?> </span>
            </div>
            <div class="flex  mt-2">
                <?php
                    foreach($genres as $genre){
                        echo '<span class="w-1/6 mr-2 font-semibold text-sm ">'. $genre->{'name'} .'</span>';
                    }
                ?>
            </div>

            <p class="my-6  text-sm"> <?php echo $plot; ?> </p>

            <div class="flex justify-start w-full h-1/3  my-4">
                <div class="w-2/3 ">
                    <iframe width="380" height="200" src=<?php echo $trailer; ?>></iframe>
                </div>
                <div class="flex flex-col justify-end w-1/4 h-full ml-8 ">
                    <div class="flex justify-between w-full">
                        <div class="">
                            <p class="italic">Rating</p>
                            <p class="text-2xl text-amber-600 font-semibold"> <?php echo $rating; ?> </p>
                        </div>
                        <div>
                            <p class="italic">Duration</p>
                            <p class="w-full text-xl font-semibold"><?php echo $duration; ?> <span class="font-light text-sm">minutes</span></p>
                        </div>
                    </div>
                    <form action="index.php" method="post" id="movie-details">
                        <input type="text" name="movie-details" value="000" hidden>
                    </form>
                    <button form="movie-details" class=" bg-amber-600 w-full py-1 mt-4 text-slate-100 text-lg rounded-full">Add Movie</button>
                </div>
            </div>
        </div>
    </div>
</div>