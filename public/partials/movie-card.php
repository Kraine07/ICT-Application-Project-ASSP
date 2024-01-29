


<div class=" group  h-full w-full     relative   " >
    <div class=" h-full w-full overflow-hidden relative">

        <!-- Poster image -->
        <img class="object-contain w-full " src=" <?php echo $row['movie_poster'];  ?>" alt="movie-poster">

        <form action="process-main.php" method="post" class="">
            <input type="text" name="movie-id" value=" <?php echo $row['movie_id'] ?>" hidden>

            <!-- Slide down panel with view details button -->
            <div class="bg-app-blue  text-gray-200 absolute h-1/2 w-full py-4  left-1/2 top-0   -translate-x-1/2 rounded-b-md hidden group-hover:flex flex-col items-center justify-between animate-drop-down  ">
                <span class="w-4/5 text-sm font-light"> <?php echo $row['movie_title']; ?> </span>
                <button class="px-6 py-1 bg-app-tertiary text-app-orange text-xs font-semibold rounded-md  ">View details</button>
            </div>
        </form>
    </div>

    <!-- Display time when it is set -->
        <?php
            echo isset($row['start']) ? '<p class="bg-app-blue w-4/5  py-1 text-center text-app-orange text-sm leading-5 font-semibold absolute bottom-0 translate-y-1/2 left-1/2 -translate-x-1/2 rounded-sm z-20">  '.date("g:i A",$row['start']).' </p>':'';
        ?>
</div>