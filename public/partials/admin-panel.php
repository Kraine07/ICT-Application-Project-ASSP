
<?php
if(!isset($_SESSION)){
    session_start();
}

require_once('error-handler.php');

if($_SESSION['auth-user'] == false){
    showErrorMessage('Please login to access this page.','index');
}



$results = $_SESSION['movie-search-results'];

?>



<div class="flex items-center w-screen h-screen">

    <div class="flex flex-col justify-between bg-blue-950 text-white h-screen w-1/4 min-w-[160px]   banner" >
        <div class="flex flex-col items-center w-full  menu">
            <!-- Profile -->
            <div class="w-full text-center  my-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-36 h-28 mx-auto">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                </svg>

                <!-- <img class="user-icon"src="./img/user-icon.png" alt="user-icon"/> -->
                <p class="text-4xl font-light  username">John Doe</p>
                <p class="font-light   role">ADMINISTRATOR</p>
            </div >


            <!-- Menu -->
            <div class="w-5/6 self-end my-8     menu-items  ">
                <button autofocus id='movies-menu-button' class='w-full font-semibold text-lg focus:bg-[#d9d9d9]  focus:text-[#141e46]    focus:outline-none py-2        selected' >Manage Movies</button>
                <button id='schedule-menu-button' class="w-full font-semibold text-lg py-2 focus:bg-[#d9d9d9]  focus:text-[#141e46]    focus:outline-none">Manage Schedules</button>
                <button id='users-menu-button' class="w-full font-semibold text-lg py-2 focus:bg-[#d9d9d9]  focus:text-[#141e46]    focus:outline-none">Manage Users</button>
            </div>
        </div>
        <!-- Logout button -->
        <div class="flex justify-center items-center my-8">
            <form id="logout" action="logout.php" method="post"></form>
            <button form="logout" class="w-3/4 py-1 bg-slate-200 text-blue-950 font-bold rounded-full hover:bg-slate-400">Logout</button>
        </div>
    </div>


    <!-- <div class=" w-1/4 h-screen bg-slate-600 ">
        <span class="mx-20">ADMIN PANEL</span>
        <form id="logout" action="logout.php" method="post"></form>
        <button form="logout" class="px-4 py-1 bg-slate-200 rounded-full">Logout</button>
        <button id="search-movie-btn" class="bg-green-300 px-12 py-2 mt-12 rounded-lg block">Find Movie</button>
    </div> -->



    <!-- Page on the right(Movie Management) -->
    <div id='manage-movies' class="bg-[#d9d9d9] items-center justify-center h-screen w-3/4 text-center text-sm   selection">
        <div class="mx-8 flex flex-col items-center justify-center">
            <!-- Heading -->
            <p class="text-blue-900 text-6xl font-light py-10   text-heading">Movie Management</p>

            <!-- Action buttons -->
            <div class="flex justify-between w-full my-6    action">

                <!-- Add Movie -->
                <div class="">
                    <button class=" bg-blue-950 text-white py-2 px-6 rounded  add-movie "  id="search-movie-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> ADD MOVIE
                    </button>
                </div>

                <!-- Search -->
                <div class="flex    search-container">
                    <select class= "bg-blue-950 text-white  p-1 px-2">
                        <option selected hidden>SEARCH BY</option>
                        <option class="bg-white text-blue-950" value="title">MOVIE TITLE</option>
                    </select>
                    <input type="search" class="text-lg p-1 border border-blue-950">
                    <button class= "bg-blue-950 p-1 px-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>

            </div>
            <!-- Movie Table -->
            <table class="table-fixed w-full bg-white border-2 border-[#d9d9d9]">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th class="py-4 border-2 border-[#d9d9d9] w-2/5" >TITLE</th>
                        <th class="border-2 border-[#d9d9d9]">DURATION</th>
                        <th class="border-2 border-[#d9d9d9]">RATING</th>
                        <th class="border-2 border-[#d9d9d9]">EDIT</th>
                    </tr>
                </thead>
                <tbody class="border-2 border-[#d9d9d9]">
                    <tr>
                        <td class="border-2 border-[#d9d9d9] py-2">The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                        <td class="border-2 border-[#d9d9d9]">123</td>
                        <td class="border-2 border-[#d9d9d9]">1961</td>
                    <td class="border-2 border-[#d9d9d9]"><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td class="border-2 border-[#d9d9d9] py-2">Witchy Woman</td>
                        <td class="border-2 border-[#d9d9d9]">241</td>
                        <td class="border-2 border-[#d9d9d9]">1972</td>
                        <td class="border-2 border-[#d9d9d9]"><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td class="border-2 border-[#d9d9d9] py-2">Shining Star</td>
                        <td class="border-2 border-[#d9d9d9]">143</td>
                        <td class="border-2 border-[#d9d9d9]">1975</td>
                        <td class="border-2 border-[#d9d9d9]"><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>




   <!-- <div class="w-3/4 h-screen bg-slate-300 overflow-auto">

<?php

 //       if($_SESSION['screen'] == "list"){

 //           foreach($results as $result){
 //               if($result->{'original_language'} == "en"){
  //                  $rating_url = 'https://api.themoviedb.org/3/movie/'.$result->{'id'}.'/release_dates';
  //                  require('title-result.php');
  //              }

 //           }

 //       }
 //       elseif($_SESSION['screen'] == "details"){

 //       }
 //       else{
 //           require_once('movie-main.php');
  //      }
    ?>

    </div> -->

    <div id="search-movie-form" class="absolute top-0 left-0 bg-[#838383cc] hidden w-screen h-screen" >
        <div class="absolute flex flex-col items-center  top-1/3 left-1/3 h-[160px] w-[380px] border-2 border-blue-950 bg-white" >
            <h1 class="text-xl text-white w-full bg-blue-950 p-4 py-2  ">Search for title</h1>
            <form action="index.php" method="post" class="w-4/5 h-2/3 flex items-center ">
                <div class="flex w-full justify-center items-center ">
                    <input class="w-3/4 border border-blue-950 px-2 py-1 focus:border-2 focus:outline-none"  type="text" name="movie_search" id="movie_search" placeholder="Movie Title" required autofocus>
                    <button class="bg-blue-950 text-white p-2 py-1 border border-blue-950">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
