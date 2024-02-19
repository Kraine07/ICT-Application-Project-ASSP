<?php
    $_SESSION['movie-id'] = $movie_id;
    $_SESSION['title'] = $title;
    $_SESSION['plot'] = $plot;
    $_SESSION['rating'] = $rating;
    $_SESSION['poster'] = $poster;
    $_SESSION['trailer'] = $trailer;
    $_SESSION['duration'] = $duration;
    $_SESSION['genres'] = $genres;
    $_SESSION['release-date'] = $release_date;
    $_SESSION['cast'] = $cast;
?>

<div  id="movie-details" class="absolute h-full w-full bg-app-modal  top-0 left-0 z-50">
    <div class="absolute w-[730px] h-auto p-8 pt-14 bg-app-secondary rounded-md  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">


        <div class="h-full w-full flex justify-between">
            <!-- poster image -->
            <div class=" flex flex-col justify-end items-start h-full w-1/3 px-2">
                <span class="text-sm italic mb-1 text-app-orange">Poster</span>
                <img class="w-full  object-contain mx-auto rounded-md" src=<?php echo $poster; ?> >
            </div>

            <div class="w-2/3 h-full text-gray-200 flex flex-col justify-between pl-8">
                <div class="flex justify-between items-start  w-full mb-3">

                    <!-- movie title -->
                    <div class="w-full flex justify-between">
                        <div class="mr-12 ">
                            <span class="text-sm italic text-app-orange block ">Title</span>
                            <span class="text-xs  "> <?php echo $title;?> </span>
                        </div>

                        <!-- Release date -->
                        <div class=" s">
                            <span class="text-sm italic text-app-orange block">Release</span>
                            <span class="text-xs italic font-light "> <?php echo date("Y",$release_date) ;?> </span>
                        </div>
                    </div>

                    <!-- close button -->
                    <span class=" cursor-pointer absolute right-2 top-2" id="close-movie-details">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <!-- cast -->
                <div class="mb-3">
                    <span class="text-sm italic text-app-orange block">Cast</span>
                    <div class="flex justify-start">
                        <?php

                        foreach($cast as $c){
                            echo "
                            <span class='text-xs font-normal mr-6'>{$c}</span>
                            ";
                        }
                        ?>
                    </div>
                </div>

                <!-- genres -->
                <div class="mb-3">
                    <span class="text-sm italic text-app-orange">Genres</span>
                    <div class="flex  ">
                        <?php
                            foreach($genres as $genre){
                                echo '<span class="w-auto mr-6  text-xs ">'. $genre->{'name'} .'</span>';
                            }
                        ?>
                    </div>
                </div>


                <!-- plot -->
                <div class="mb-3 overflow-hidden">
                    <span class="text-sm italic text-app-orange">Plot</span>
                    <p class=" text-xs truncate"> <?php echo $plot; ?> </p>
                </div>


                <div class="flex justify-between w-full  ">

                    <!-- trailer -->
                    <div class="w-7/12 h-[120px]">
                        <span class="text-sm italic pb-1 text-app-orange">Trailer</span>
                        <iframe class="w-3/4 h-5/6 " src=<?php echo $trailer; ?>></iframe>
                    </div>

                    <div class="flex flex-col justify-between w-5/12 h-[120px] items-center ">
                        <div class="flex justify-between  w-full mx-auto">

                            <!-- rating -->
                            <div class="">
                                <span class="text-sm italic text-app-orange">Rating</span>
                                <p class="text-sm text-gray-200 font-semibold"> <?php echo $rating; ?> </p>
                            </div>

                            <!-- duration -->
                            <div>
                                <span class="text-sm italic text-app-orange">Duration</span>
                                <p class="w-full text-sm font-semibold block"><?php echo $duration; ?><span class=" text-sm">mins</span></p>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <form action="manage-movie.php" method="post" class="w-full   m-0">
                            <input type="text" name="movie-details" value="000" hidden>
                            <button class="block bg-app-blue w-full py-1 text-app-orange text-lg rounded-md hover:bg-blue-950">Add Movie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>