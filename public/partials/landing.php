

<!-- Login form modal -->
<?php
    require_once('login-form-modal.php');
?>


<!-- Page Content -->
<div class="relative overflow-hidden  h-full w-full">
    <div class="flex  h-full w-full">
        <div class="w-3/5 h-full">
            <img src="./img/cinema-4398725_1280.png" alt="" class="h-full object-cover">
            <div>
                <img src="./img/kisspng-cinema-film-movie-theatre-5ac068632302c2.1016541515225590751434.png" alt="" class="h-2/3 object-contain absolute -bottom-20  z-20 ">
            </div>
        </div>

        <div class="absolute w-11/12 aspect-square rounded-full bg-blue-950 -right-1/4 self-center border-gray-200 border-2 "></div>

        <div class=" w-3/5  flex flex-col justify-evenly items-end z-10">
            <button id="login" class=" bg-gray-300 w-1/4 rounded-l-full justify-self-start">Admin Panel</button>
            <div class=" flex flex-col items-end mr-12 justify-between">
                <h1 class="text-8xl text-gray-300 font-light text-right w-3/5">Backyard Cinema</h1>
                <a href="main.php" class="bg-red-900 text-gray-300 text-center text-xl font-semibold py-2 w-3/5 rounded-full my-8">Enter
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>