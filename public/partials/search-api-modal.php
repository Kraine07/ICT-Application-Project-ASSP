

<!-- Search movie-api modal window -->
<div id="search-movie-form" class="absolute top-0 left-0 bg-[#838383cc] hidden w-screen h-screen" >
        <div class="absolute flex flex-col items-center  top-1/3 left-1/3 h-[200px] w-[380px] border-2 border-blue-950 bg-white" >
            <div class="flex justify-between text-xl text-white text-left  w-full bg-blue-950 ">
                <h1 class=" font-light px-4 py-1">Search for title</h1>
                <!-- close button -->
                <span class="p-2 float-right  text-xs cursor-pointer" id="close-movie-details">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </span>
            </div>

            <form action="manage-movie.php" method="post" class="w-4/5 h-2/3 flex flex-col justify-center items-start ">
                <span class="text-xs text-slate-800 text-left leading-3 mb-4  italic">Enter the title of the movie you wish to add. Partial searches allowed.</span>
                <label for="movie-search">Movie Title <span class="text-red-500">*</span></label>
                <div class="flex w-full justify-start items-center border border-blue-950 mt-1">
                    <input  class="w-full h-full border border-none px-2 py-1  focus:outline-none"  type="text" name="search_movie" id="movie_search"  required >
                    <button class="h-full bg-blue-950 text-white px-2 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>