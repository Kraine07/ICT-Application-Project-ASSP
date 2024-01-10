


<div class=" group  h-full w-4/5     relative    " >
    <img class="object-contain w-full " src=" <?php echo $row['movie_poster'];  ?>" alt="movie-poster">
    <div>
        <?php
            echo isset($row['start']) ? '<p class="bg-[#ffffffaa] w-full py-1 text-center text-blue-950 text-lg leading-5 font-bold absolute bottom-0">  '.date("g:i A",$row['start']).' </p>':'';
            echo isset($row['start']) ? '<p class="bg-[#ffffff88] w-full py-1 text-center text-blue-950 text-lg font-bold leading-5 absolute top-0">  '.$row['movie_title'].' </p>':'';
        ?>

    </div>
    <form action="process-main.php" method="post">
        <input type="text" name="movie-id" value=" <?php echo $row['movie_id'] ?>" hidden>
        <button class=" bg-white w-[120px] py-1 text-sm absolute top-1/2  left-1/2  -translate-x-1/2 rounded-full hidden group-hover:block  ">View details</button>
    </form>
</div>