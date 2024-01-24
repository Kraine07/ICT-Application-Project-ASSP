
<div class="h-screen w-screen bg-app-secondary absolute top-0 left-0 z-50  <?php echo $_SESSION['watch-trailer']?"block":"hidden"  ?>">
    <form action="main.php" method="post" id="close-movie-info">
            <input type="text" name="close-movie-info" hidden>
    </form>
    <button class="self-start text-white absolute right-8 top-8" form="close-movie-info" >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <iframe class="absolute h-3/4 w-4/5 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2" src="  <?php  echo $_SESSION['watch-trailer']? $_SESSION['trailer-link']:""   ?>  "></iframe>
</div>


<?php

$_SESSION['watch-trailer'] = false;


?>