

<!-- Login form modal -->
<?php
    require_once('login-form-modal.php');
?>


<!-- Page Content -->
<div class="relative overflow-hidden  h-full w-full">
    <div class="flex  h-full w-full">
        <div class="w-full h-full">
            <img src="./img/cinema-4398725_1280.png" alt="" class="h-full sm:w-full lg:w-2/3 object-cover grayscale-[80%]">
            <div>
                <img src="./img/kisspng-cinema-film-movie-theatre-5ac068632302c2.1016541515225590751434.png" alt="" class="w-3/5 lg:w-[600px] object-contain absolute -bottom-24 left  z-20 grayscale-[80%] ">
            </div>
        </div>

        <div class="absolute w-[740px] md:w-[800px] lg:w-11/12 aspect-square rounded-full bg-app-blue -right-1/2 sm:-right-1/4 md:-right-1/4 self-center border-gray-200 border-2 "></div>

        <div class=" w-3/5  flex flex-col justify-evenly items-end z-10">
            <button id="login" class=" bg-app-secondary text-white text-xs py-1 px-2 rounded-l-full justify-self-start">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor" class="w-4 h-4 inline mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                </svg>
                <span class="hidden sm:inline">Admin Panel</span>
            </button>
            <div class=" w-[200px] md:w-3/4 flex flex-col items-end mr-12 justify-between">
                <!-- <h1 class="text-8xl text-gray-300 font-light text-right w-3/5">Backyard Cinema</h1> -->
                <img src="./img/logo_new_light.png" alt="logo" class="w-full object-contain">
                <a href="main.php" class="bg-app-orange text-gray-200 text-center text-xl font-semibold py-1 w-full rounded-full my-8  ">Enter
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline animate-push">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>