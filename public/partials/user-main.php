<?php
require_once('dbConn.php');
$db_users_sql = "SELECT `user_id`,`first_name`,`last_name`,`email`,`role` FROM `{$database}`.`{$user_table}`"; // TODO JOIN
$result = mysqli_query($conn, $db_users_sql);
 require_once('user-form.php');
?>



<div class=" flex flex-col items-center justify-center w-full px-4">
    <!-- Heading -->
    <p class="text-blue-950 text-6xl font-light py-10   text-heading">User  Management</p>

    <!-- Action buttons -->
    <div class="flex justify-between w-full my-6  action">

        <!-- New User -->
        <div class="w-full  flex justify-start ">
            <button class=" bg-blue-950 text-white p-2 lg:px-6  rounded  new-schedule "  id="new-user-btn">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> <span class="hidden lg:inline">NEW USER</span> 
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
    <!-- Schedule Table -->
    <table class="table-fixed w-full bg-white border-2 border-[#d9d9d9]">
        <thead class="bg-blue-950 text-white">
            <tr>
                <th class="py-4 border-2 border-[#d9d9d9] w-5/12" >USERNAME</th>
                <th class="border-2 border-[#d9d9d9] ">EMAIL</th>
                <th class="border-2 border-[#d9d9d9]">ROLE</th>

                <th class="border-2 border-[#d9d9d9] ">edit</th>
            </tr>
        </thead>
        <tbody class="border-2 border-[#d9d9d9]">
            <?php
            while($row = mysqli_fetch_assoc($result)){
                echo '
                    <tr>
                        <td class="border-2 border-[#d9d9d9] py-2">'.$row['first_name'].' '.$row['last_name'].'</td>
                        <td class="border-2 border-[#d9d9d9]">'.$row['email'].'</td>
                        <td class="border-2 border-[#d9d9d9] capitalize">'.$row['role'].'</td>
                        <td class="border-2 border-[#d9d9d9]  ">
                        ';
                if (!($_SESSION['auth-user']['user_id'] == $row['user_id']))
                    echo '<div>
                            <form action="edit-user.php" method="post" class="inline">
                                <input name="edit-id" type="text" value="'.$row['user_id'].'" hidden>
                                <input name="first-name" type="text" value="'.$row['first_name'].'" hidden>
                                <input name="last-name" type="text" value="'.$row['last_name'].'" hidden>
                                <input name="email" type="text" value="'.$row['email'].'" hidden>
                                <input name="role" type="text" value="'.$row['role'].'" hidden>
                                <input name="edit-option" type="text" value="edit" hidden>
                                <button class="text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                            </form>
                            <form action="edit-user.php" method="post" class="inline">
                                <input name="edit-id" type="text" value="'.$row['user_id'].'" hidden>
                                <input name="first-name" type="text" value="'.$row['first_name'].'" hidden>
                                <input name="last-name" type="text" value="'.$row['last_name'].'" hidden>
                                <input name="email" type="text" value="'.$row['email'].'" hidden>
                                <input name="role" type="text" value="'.$row['role'].'" hidden>

                                <input name="edit-option" type="text" value="delete" hidden>
                                <button class="text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>';
                echo '
                        </td>
                    </tr>
                ';
            }            
            ?>
        </tbody>
    </table>
</div>