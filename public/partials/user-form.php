<?php



?>


<!--  User form modal window -->
<div id="user-form" class="absolute top-0 left-0 bg-app-modal  w-full h-full z-30   <?php echo $_SESSION['user-edit'] ? "": "hidden" ?>   " >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-auto w-[340px] border-2 border-app-blue bg-app-tertiary rounded-md" >
        <h1 class="text-gray-200 text-lg text-left bg-app-blue w-full pl-6 pr-2 py-2"><?php echo $_SESSION['user-edit']? "Edit": "Create";?> User
            <button class="float-right inline-block" id="close-user-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>

        <!-- user form -->
        <form action="manage-user.php" method="post" class="flex flex-col text-sm items-start w-full h-full px-6 pb-4">

            <p class="text-xs  italic text-left my-2 w-full"> Required fields<span class="text-lg text-app-orange ml-1">*</span> </p>

            <input type="text" name="user-id" value=" <?php echo $_SESSION['user-edit'] ? $_SESSION['user-id']:"";  ?>  " hidden>

            <!-- first name -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="first-name" class="text-md font-semibold ">First Name <span class="text-red-600">*</span></label>
                <input id="first-name" type="text" name="<?php   echo $_SESSION['user-edit'] ? "edit-fname" : "first-name";   ?>" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  value = "<?php  echo $_SESSION['user-edit']? $_SESSION['first-name'] :"";   ?>" placeholder="Enter first name" required>
            </div>

            <!-- last name -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="last-name" class="text-md font-semibold ">Last Name <span class="text-red-600">*</span></label>
                <input id="last-name" type="text" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" name="last-name" value="<?php  echo $_SESSION['user-edit']? $_SESSION['last-name'] :"";   ?>" placeholder="Enter last name" required>
            </div>

            <!-- email -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="email" class="text-md font-semibold ">Email <span class="text-red-600">*</span></label>
                <input id="email" type="email" name="email" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" value = "<?php  echo $_SESSION['user-edit']? $_SESSION['email'] :"";   ?>" placeholder="Enter email" required>
            </div>
            <?php

                if(!$_SESSION['user-edit']){
                    echo
                    '

                    <div class="flex flex-col items-start w-full mb-2">
                        <label for="password" class="text-md font-semibold ">Password <span class="text-red-600">*</span></label>
                        <input id="password" type="password" name="password" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"   pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  placeholder="Enter password" required>
                    </div>


                    <div class="flex flex-col items-start w-full mb-2">
                        <label for="c-password" class="text-md font-semibold ">Confirm Password <span class="text-red-600">*</span></label>
                        <input id="c-password" type="password" name="c-password" class="py-1 rounded-sm w-full bg-gray-200 text-app-blue   outline-none ring-0 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  placeholder="Confirm password" required>
                    </div>
                    ';
                }

                // prevent logged in admin from changing his/her role
                if($_SESSION['role'] == 'administrator' && $_SESSION['auth-user']['role'] == $_SESSION['role'] && $_SESSION['auth-user']['user_id'] == $_SESSION['user-id']){
                    $attr = "disabled";
                }else{
                    $attr ="";
                }


            ?>

            <!-- role -->
            <span>Select Role</span>
            <div class="flex items-center ml-2 my-1">
                <input type="radio" name="role" id="admin" class=" w-4 h-4 mr-2 " value="administrator" <?php echo ($_SESSION['user-edit'] && $_SESSION['role'] == 'administrator')?"checked":"";  ?> >
                <label class="text-sm" for="admin">Administrator</label>
            </div>
            <div class="flex items-center ml-2 my-1">
                <input type="radio" name="role" id="sup" class="w-4 h-4 mr-2 peer " value="supervisor" <?php  echo ($_SESSION['user-edit'] && $_SESSION['role'] == 'administrator')? $attr :"checked";?>  >
                <label class="text-sm peer-disabled:line-through peer-disabled:italic" for="sup">Supervisor</label>
            </div>

            <!-- submit button -->
            <button class="bg-app-blue text-app-orange w-full py-2 my-3  rounded-md">Create User</button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['user-edit'] = false;
?>