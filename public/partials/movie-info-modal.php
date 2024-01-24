<?php

if(!isset($_SESSION)){
    session_start();
}

?>


<div class="h-screen w-screen bg-[#0f0f0fdd] absolute top-0 left-0 z-50  <?php echo $_SESSION['movie-info']?"block":"hidden"  ?>">
    <div class="flex justify-around absolute h-[360px] w-[800px] bg-app-secondary text-gray-200 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-6  rounded-md">
        <div class="w-1/3 ">
            <img src=" <?php  echo $_SESSION['movie-info'] ?  $_SESSION['patron-movie']['movie_poster']  :"";    ?>   " alt="poster img" class="h-full object-contain ">
        </div>
        <div class="w-2/3 h-full  p-4 flex flex-col ">
            <div class="mb-4 w-full flex justify-between">
                <span class="text-2xl font-semibold leading-6 w-4/5">  <?php  echo $_SESSION['movie-info'] ?  $_SESSION['patron-movie']['movie_title']  :"";    ?>  </span>
                <form action="process-main.php" method="post" id="close-movie-info">
                    <input type="text" name="close-movie-info" hidden>
                </form>
                <button class="self-start cursor-pointer" form="close-movie-info" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-sm my-4  h-3/5 leading-4">   <?php  echo $_SESSION['movie-info'] ?  $_SESSION['patron-movie']['movie_plot']  :"";    ?>  </p>

            <div>
                <?php
                $genres = $_SESSION['patron-genres'];
                    foreach($genres as $genre){
                        echo '
                            <span class="mr-6 text-sm font-semibold">'.$genre.'</span>
                        ';
                    }
                ?>

            </div>
            <div class="justify-self-end mt-4">
                <span class="text-xl font-light mr-8">   <?php  echo $_SESSION['movie-info'] ?  gmdate("g\h\\r i\m\i\\n", ($_SESSION['patron-movie']['movie_duration']*60))  :"";    ?>  </span>
                <span class="text-lg font-bold">   <?php  echo $_SESSION['movie-info'] ?  $_SESSION['patron-movie']['movie_rating']  :"";    ?>  </span>

                <form action="process-main.php" method="post">
                    <input type="text" name="trailer-link" value="<?php echo $_SESSION['patron-movie']['movie_trailer'];?>" hidden>
                    <button class=" bg-app-orange text-app-blue py-1 px-8 rounded-full float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                        </svg>

                        Watch Trailer
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>


<?php

$_SESSION['movie-info'] = false;

?>