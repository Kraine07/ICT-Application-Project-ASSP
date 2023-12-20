<?php
require_once('dbConn.php');
$db_movies_sql = "SELECT * FROM `{$database}`.`{$movie_table}`";


?>



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