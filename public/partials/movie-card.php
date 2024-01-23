


<div class=" group  h-full w-full     relative  overflow-hidden  " >
    <img class="object-contain w-full " src=" <?php echo $row['movie_poster'];  ?>" alt="movie-poster">
    <div>
        <?php
            echo isset($row['start']) ? '<p class="bg-[#ffffffcc] w-full py-1 text-center text-blue-950 text-sm leading-5 font-semibold absolute bottom-0">  '.date("g:i A",$row['start']).' </p>':'';
            echo isset($row['start']) ? '<p class="bg-[#ffffffcc] w-full py-1 text-center text-blue-950 text-sm font-semibold leading-5 absolute top-0">  '.$row['movie_title'].' </p>':'';
        ?>

    </div>
    <form action="process-main.php" method="post" class="">
        <input type="text" name="movie-id" value=" <?php echo $row['movie_id'] ?>" hidden>
        <button class=" bg-app-orange  w-full h-full py-1 text-sm text-app-blue font-semibold  absolute -top-1/4  left-1/2  -translate-x-1/2 rounded-md hidden group-hover:block  animate-drop-down ">View details</button>
    </form>
</div>