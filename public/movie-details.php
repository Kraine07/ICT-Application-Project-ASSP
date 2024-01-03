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

<div  id="movie-details" class="absolute h-full w-full bg-[#838383cc] top-0 left-0 z-50">
    <div class="absolute w-2/3 h-[450px] pt-8  px-12 bg-white shadow-custom-sm   left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">


        <div class="h-full flex justify-between">
            <!-- poster image -->
            <div class=" flex flex-col justify-end h-full w-1/4 pb-10">
                <img class="w-full object-contain mx-auto" src=<?php echo $poster; ?> >
            </div>
            <div class="w-2/3 h-full    text-slate-700 flex flex-col justify-between  ">
                <div class="flex justify-between items-start mb-2">

                    <!-- movie title -->
                    <span class="text-2xl font-light "> <?php echo $title;?> </span>

                    <!-- close button -->
                    <span class="px-6 py-1 rounded-full text-xs cursor-pointer" id="close-movie-details">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>

                <!-- genres -->
                <div class="flex  ">
                    <?php
                        foreach($genres as $genre){
                            echo '<span class="w-auto mr-6 font-semibold text-sm ">'. $genre->{'name'} .'</span>';
                        }
                    ?>
                </div>

                <!-- plot -->
                <p class="bg-white my-2 h-[70px] text-xs z-10 text-ellipsis overflow-hidden hover:overflow-visible"> <?php echo $plot; ?> </p>


                <div class="flex justify-between w-full h-[200px] justify-self-end   pb-10 ">
                    <!-- trailer -->
                    <div class="self-end ">
                        <iframe width="240" height="140" src=<?php echo $trailer; ?>></iframe>
                    </div>

                    <div class="flex flex-col justify-between w-5/12 h-[140px] items-center self-end ">
                        <div class="flex justify-between  w-full mx-auto">
                            <!-- rating -->
                            <div class="">
                                <p class="italic">Rating</p>
                                <p class="text-2xl text-blue-950 font-semibold"> <?php echo $rating; ?> </p>
                            </div>
                            <!-- duration -->
                            <div>
                                <p class="italic">Duration</p>
                                <p class="w-full text-xl font-semibold block"><?php echo $duration; ?><span class=" text-sm">mins</span></p>
                            </div>
                        </div>
                        <form action="index.php" method="post" class="w-full">
                            <input type="text" name="movie-details" value="000" hidden>

                            <button class=" bg-blue-950 w-full py-1 mt-4 text-slate-100 text-lg rounded-full">Add Movie</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>