<!-- Search movie-api modal window -->
<div id="search-movie-form" class="absolute top-0 left-0 bg-[#838383cc] hidden w-screen h-screen" >
        <div class="absolute flex flex-col items-center  top-1/3 left-1/3 h-[160px] w-[380px] border-2 border-blue-950 bg-white" >
            <h1 class="text-xl text-white text-left  w-full bg-blue-950 px-4 py-2  ">Search for title</h1>
            <form action="index.php" method="post" class="w-4/5 h-2/3 flex flex-col justify-center items-start ">
                <label for="movie-search"><span class="text-red-500">*</span>Movie Title</label>
                <div class="flex w-full justify-start items-center ">
                    <input  class="w-full border border-blue-950 px-2 py-1 focus:border-2 focus:outline-none"  type="text" name="search_movie" id="movie_search"  required >
                    <button class="bg-blue-950 text-white p-1  border border-blue-950">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>