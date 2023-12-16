<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-styles.css">
    <link rel="stylesheet" href="styles.css">
    <title>Admin Panel</title>
</head>
<body>
    <!-- Page Container -->
    <div class="flex w-full sa" >
        <!-- Left banner -->
        <div class="bg-blue-950 text-white px-12 h-screen banner" >
            <div class="menu">
                <!-- Profile -->
                <div class="my-8">
                    <img class="user-icon"src="./img/user-icon.png" alt="user-icon"/>
                    <p class="username">John Doe</p>
                    <p class="role">ADMINISTRATOR</p>
                </div >
                <!-- Menu -->
                <div class="menu-items">
                    <div id='movies-menu-button' class='selected'>Manage Movies</div>
                    <div id='schedule-menu-button'>Manage Schedules</div>
                    <div id='users-menu-button'>Manage Users</div>
                </div>
            </div>
        </div>
        <!-- Page on the right(Movie Management) -->
        <div id='manage-movies' class="items-center justify-center h-fscreen  text-center selection">
            <!-- Heading -->
            <p class="text-blue-900 text-heading">Movie Management</p>
            <!-- Action buttons -->
            <div class="flex justify-between action">
                <!-- Add Movie -->
                <button class="bg-blue-950 w-2\/5 border-gray-200 text-white py-2 px-3 rounded font-semibold add-movie flex-1" >
                    <img src="./img/add-icon.png" alt="add icon">ADD MOVIE
                </button>
                <!-- Search -->
                <div class="search-container">
                    <button class= "bg-blue-950 text-white font-semibold">SEARCH BY<img src="./img/dropdown-icon.png" alt="dropdown arrow"></button>
                    <input type= "text"/>
                    <span class= "bg-blue-950"><img src="./img/search-icon.png" alt="search"></span>
                </div>
            </div>
            <!-- Movie Table -->
            <table class="table-fixed">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th>TITLE</th>
                        <th>DURATION</th>
                        <th>RATING</th>
                        <th>EDIT</th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr>
                        <td>The Sliding Mr. Bones (Next Stop, Pottersville)</td>
                        <td>123</td>
                        <td>1961</td>
                    <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td>Witchy Woman</td>
                        <td>241</td>
                        <td>1972</td>
                        <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td>Shining Star</td>
                        <td>143</td>
                        <td>1975</td>
                        <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td> 
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Page on the right(Schedule Management) -->
        <div id='manage-schedule' class="items-center hidden justify-center h-fscreen  text-center selection">
            <!-- Heading -->
            <p class="text-blue-900 text-heading">Schedule Management</p>
            <!-- Action buttons -->
            <div class="flex justify-between action">
                <!-- Add Schedule -->
                <button class="bg-blue-950 w-2\/5 border-gray-200 text-white py-2 px-3 rounded font-semibold add-movie flex-1" >
                    <img src="./img/add-icon.png" alt="add icon">NEW
                </button>
                <!-- Search -->
                <div class="search-container">
                    <button class= "bg-blue-950 text-white font-semibold">SEARCH BY<img src="./img/dropdown-icon.png" alt="dropdown arrow"></button>
                    <input type= "text"/>
                    <span class= "bg-blue-950"><img src="./img/search-icon.png" alt="search"></span>
                </div>
            </div>
            <!-- Schedule Table -->
            <table class="table-fixed">
                <thead class="bg-blue-950 text-white">
                    <tr>
                        <th>MOVIE</th>
                        <th>SCREEN</th>
                        <th>DATE</th>
                        <th>START</th>
                        <th>END</th>
                        <th><img class='gear-icon' src="./img/Gear-icon.png" alt="edit icon"></th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr>
                        <td>The Sliding Mr. Bones</td>
                        <td>SCREEN NAME</td>
                        <td>22-12-23</td>
                        <td>5:30</td>
                        <td>7:45</td>
                    <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td>The Sliding Mr. Bones</td>
                        <td>SCREEN NAME</td>
                        <td>22-12-23</td>
                        <td>5:30</td>
                        <td>7:45</td>
                    <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                    <tr>
                        <td>The Sliding Mr. Bones</td>
                        <td>SCREEN NAME</td>
                        <td>22-12-23</td>
                        <td>5:30</td>
                        <td>7:45</td>
                    <td><button><img class="edit-icon" src="./img/edit-icon.png" alt="edit icon"></button><button><img class="delete-icon" src="./img/delete-icon.png" alt="delete icon"></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script src="admin-script.js"></script>
</body>
</html>