<?php
require_once('./partials/head.php');

?>
<div class="container top-0 left-0 bg-blue-950 text-white ">

<!-- Slide -->

    <div class="slideshow h-screen w-screen">
    <div class="slides h-3/4 w-1/2 bg-gray-400  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 absolute rounded-lg  ">
        <div class="flex items-center h-full w-full p-6">
            <div class="w-1/2 h-full">
                <img class="object-cover h-full rounded-lg" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
            </div>

            <div class="flex flex-col justify-evenly w-1/2 h-full px-6 text-black">
                <h1 class="text-4xl font-semibold">Movie Title</h1>
                <p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa accusantium ab doloribus delectus? Temporibus quas expedita dicta perspiciatis, fugit ea ex voluptates hic vero deserunt cupiditate voluptate illo quo corporis dolorem modi? Placeat, dolorem. Officia nesciunt praesentium aliquam doloribus dolores voluptatem, optio dignissimos temporibus eveniet ipsa. Adipisci vel illum suscipit!</p>
                <div class="flex justify-between w-full">
                    <div class="w-3/4">
                        <span class="block text-xl">Screen Name</span>
                        <span class="block text-4xl text-red-700 font-semibold">8:30PM</span>
                    </div>
                    <div class="text-4xl p-2 w-1/4 text-center border-blue-950 border-2 rounded-md">R</div>
                </div>
                <button class="bg-blue-950 text-white w-full text-2xl py-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 aspect-square inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                    </svg>
                    Watch Trailer
                </button>
            </div>
        </div>


    </div>





    <div class="slides bg-red-600 h-3/4 w-1/2 p-12 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 absolute rounded-lg border-white border-2 ">
        <p>Second slide</p>
    </div>
    <div class="slides bg-gray-600 h-3/4 w-1/2 p-12 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 absolute rounded-lg border-white border-2 ">
        <p>Third slide</p>
    </div>

    <span class="absolute left-[20%] p-2 top-1/2 text-2xl w-10  text-center  cursor-pointer " onclick="nextSlide(-1)">&#10094;</span>
    <span class="absolute right-[20%] p-2 top-1/2 text-2xl w-10  text-center  cursor-pointer " onclick="nextSlide(1)">&#10095;</span>

    <div class="circles z-50 text-center absolute bottom-[6%] right-1/2 translate-x-1/2">
        <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(1)"></span>
        <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(2)"></span>
        <span class="dot bg-white h-4 aspect-square rounded-full relative inline-block cursor-pointer" onclick="currentSlide(3)"></span>
    </div>
    </div>







<!-- On today -->
    <div class="today bg-white w-screen h-screen mt-20 top-full">
        <div class="p-4">
            <span class="text-4xl text-black mr-28">On Today</span>
            <button class=" text-black text-md py-1 px-4 mx-10 shadow-custom-sm focus:bg-blue-950 focus:text-white focus:shadow-none rounded-md">Screen 1</button>
            <button class=" text-black text-md py-1 px-4 mx-10 shadow-custom-sm focus:bg-blue-950 focus:text-white focus:shadow-none rounded-md">Screen 2</button>
            <button class=" text-black text-md py-1 px-4 mx-10 shadow-custom-sm focus:bg-blue-950 focus:text-white focus:shadow-none rounded-md">Screen 3</button>
            <button class=" text-black text-md py-1 px-4 mx-10 shadow-custom-sm focus:bg-blue-950 focus:text-white focus:shadow-none rounded-md">Screen 4</button>
        </div>
        <div class="movie h-4/5 w-5/6 grid grid-cols-4 gap-4 mx-auto text-black">
            <div class="h-full w-4/5 ">
                <span class="block text-center">Movie Title</span>
                <img class="object-cover" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
                <div class="flex justify-around text-xl font-bold">
                    <span>5:30PM</span>
                    <span>5:30PM</span>
                </div>
                
            </div>
            <div class="h-full w-4/5">
                <span class="block text-center">Movie Title</span>
                <img class="object-cover" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
                <div class="flex justify-around text-xl font-bold">
                    <span>5:30PM</span>
                    <span>5:30PM</span>
                </div>
                
            </div>
            <div class="h-full w-4/5">
                <span class="block text-center">Movie Title</span>
                <img class="object-cover" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
                <div class="flex justify-around text-xl font-bold">
                    <span>5:30PM</span>
                    <span>5:30PM</span>
                </div>
                
            </div>
            <div class="h-full w-4/5">
                <span class="block text-center">Movie Title</span>
                <img class="object-cover" src="https://cdn.pixabay.com/photo/2017/07/26/06/31/road-2540632_1280.jpg" alt="movie-poster">
                <div class="flex justify-around text-xl font-bold">
                    <span>5:30PM</span>
                    <span>5:30PM</span>
                </div>
                
            </div>
        </div>

    </div>
</div>

<?php
require_once('./partials/footer.php');

?>