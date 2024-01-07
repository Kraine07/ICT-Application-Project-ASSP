<?php
require_once('dbConn.php');

// get all movies
$db_movies_sql = "SELECT * FROM `{$database}`.`{$movie_table}` ORDER BY `movie_title`";
if($result = mysqli_query($conn, $db_movies_sql)){
    $_SESSION['movies'] = $result;
}
else{
    showErrorMessage("Error getting movies. Please reload page or contact technical support");
}

require_once('search-api-modal.php');

?>



<div class="mx-8 flex flex-col items-center justify-center">
            <!-- Heading -->
            <p class="text-blue-900 text-6xl font-light py-10   text-heading">Movie Management</p>

            <!-- Action buttons -->
            <div class="flex justify-between w-full my-6    action">

                <!-- Add Movie -->
                <div class="">
                    <button class=" bg-blue-950 text-white p-2 lg:px-6  rounded  add-movie "  id="search-movie-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> <span class="hidden lg:inline">ADD MOVIE</span>
                    </button>
                </div>

                <!-- Search -->
                <div class="flex    search-container">
                    <select class= "bg-blue-950 text-white  p-1 px-2">
                        <option selected hidden>SEARCH BY</option>
                        <option class="bg-white text-blue-950" value="title">TITLE</option>
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
                        <th class="py-4 border-2 border-[#d9d9d9] w-1/2" >TITLE</th>
                        <th class="border-2 border-[#d9d9d9]">DURATION</th>
                        <th class="border-2 border-[#d9d9d9]">RATING</th>
                        <th class="border-2 border-[#d9d9d9] ">EDIT</th>
                    </tr>
                </thead>
                <tbody class="border-2 border-[#d9d9d9]">
                    <?php
                    while($row = mysqli_fetch_array($result)){
                        // format movie duration
                        $duration = gmdate("g\h\\r i\m\i\\n", ($row['movie_duration']*60));


                        // table rows
                        echo '
                            <tr>
                                <td class="border-2 border-[#d9d9d9] py-2">'.$row['movie_title'].'</td>
                                <td class="border-2 border-[#d9d9d9]">'.$duration.'</td>
                                <td class="border-2 border-[#d9d9d9]">'.$row['movie_rating'].'</td>
                                <td class="border-2 border-[#d9d9d9]  ">
                                    <form action="edit-movie.php" method="post" class="inline">
                                        <input name="edit-id" type="text" value="'.$row['movie_id'].'" hidden>
                                        <input name="edit-option" type="text" value="edit" hidden>
                                        <button class="text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="edit-movie.php" method="post" class="inline">
                                        <input name="edit-id" type="text"  value="'.$row['movie_id'].'" hidden>
                                        <input name="edit-option" type="text" value="delete" hidden>
                                        <button class="text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ';

                    }
                    ?>
                </tbody>
            </table>
        </div>