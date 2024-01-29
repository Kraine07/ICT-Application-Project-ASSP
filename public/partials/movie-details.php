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

<div  id="movie-details" class="absolute h-full w-full bg-app-modal  top-0 left-0 z-50">
    <div class="absolute w-2/3 h-[450px] pt-8  px-12 bg-app-secondary shadow-custom-sm   left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">


        <div class="h-full flex justify-between ">
            <!-- poster image -->
            <div class=" flex flex-col justify-end h-full w-1/4 pb-10">
                <span class="text-sm italic text-app-orange">Poster</span>
                <img class="w-full object-contain mx-auto pt-1" src=<?php echo $poster; ?> >
            </div>
            <div class="w-2/3 h-full    text-gray-200 flex flex-col justify-between  ">
                <div class="flex justify-between items-start mb-2">

                    <!-- movie title -->
                    <div class="">
                        <span class="text-sm italic text-app-orange block">Title</span>
                        <span class="text-2xl font-light "> <?php echo $title;?> </span>
                    </div>

                    <!-- close button -->
                    <span class=" cursor-pointer" id="close-movie-details">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <!-- genres -->
                <div>
                    <span class="text-sm italic text-app-orange">Genres</span>
                    <div class="flex  ">
                        <?php
                            foreach($genres as $genre){
                                echo '<span class="w-auto mr-6 font-semibold text-sm ">'. $genre->{'name'} .'</span>';
                            }
                        ?>
                    </div>
                </div>


                <!-- plot -->
                <div class="h-1/5">
                    <span class="text-sm italic text-app-orange">Plot</span>
                    <p class=" text-xs text-ellipsis overflow-hidden hover:overflow-visible"> <?php echo $plot; ?> </p>
                </div>


                <div class="flex justify-between w-full h-[200px] justify-self-end   pb-10 ">
                    <!-- trailer -->
                    <div class="self-end w-1/2">
                        <span class="text-sm italic text-app-orange">Trailer</span>
                        <iframe class="w-full h-full pt-1" src=<?php echo $trailer; ?>></iframe>
                    </div>

                    <div class="flex flex-col justify-between w-5/12 h-full items-center self-end ">
                        <div class="flex justify-between  w-full mx-auto">
                            <!-- rating -->
                            <div class="">
                                <span class="text-sm italic text-app-orange">Rating</span>
                                <p class="text-2xl text-gray-200 font-semibold"> <?php echo $rating; ?> </p>
                            </div>
                            <!-- duration -->
                            <div>
                                <span class="text-sm italic text-app-orange">Duration</span>
                                <p class="w-full text-xl font-semibold block"><?php echo $duration; ?><span class=" text-sm">mins</span></p>
                            </div>
                        </div>
                        <form action="manage-movie.php" method="post" class="w-full  self-end m-0">
                            <input type="text" name="movie-details" value="000" hidden>

                            <button class="block bg-app-blue w-full py-1 text-app-orange text-lg rounded-md">Add Movie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>