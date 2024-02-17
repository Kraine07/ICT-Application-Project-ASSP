

<!-- Search movie-api modal window -->
<div id="search-movie-form" class="absolute top-0 left-0 bg-app-modal hidden w-screen h-screen z-10  " >
        <div class="absolute flex flex-col items-center  top-1/3 left-1/3 h-[200px] w-[380px]  bg-app-tertiary rounded-md " >
            <div class="flex justify-between text-xl text-gray-200 text-left  w-full bg-app-blue rounded-t-md">
                <h1 class=" font-light px-4 py-1">Find Movie</h1>
                <!-- close button -->
                <span class="p-2 float-right  text-xs cursor-pointer" id="close-search-movie-form">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <form action="manage-movie.php" method="post" class="w-4/5 h-2/3 flex flex-col justify-center items-start ">
                <p class="text-xs text-left italic mb-4 w-full">Required fields <span class="text-app-orange">*</span></p>
                <label for="movie-search">Movie Title <span class="text-red-500">*</span></label>
                <div class="flex w-full justify-start items-center bg-gray-200 rounded-[4px] rounded-r-md  mt-1  ">
                    <input  class="w-full h-full bg-transparent rounded-[4px] text-app-blue  border-none px-2 py-1 focus:outline-none"  type="text" name="search_movie" id="movie_title"  required >
                    <button class="h-full aspect-square bg-app-blue text-app-orange  rounded-r-[4px] flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class=" aspect-square h-2/3 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>