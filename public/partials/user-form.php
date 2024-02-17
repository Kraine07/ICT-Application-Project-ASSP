<?php



?>


<!--  User form modal window -->
<div id="user-form" class="absolute top-0 left-0 bg-app-modal  w-full h-full z-30   <?php echo $_SESSION['user-edit'] ? "": "hidden" ?>   " >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-auto w-[300px] border-2 border-app-blue bg-app-tertiary" >
        <h1 class="text-gray-200 text-lg text-left bg-app-blue w-full px-[24px] py-2"><?php echo $_SESSION['user-edit']? "Edit": "Create";?> User
            <button class="float-right inline-block" id="close-user-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>

        <!-- user form -->
        <form action="manage-user.php" method="post" class="flex flex-col  items-start w-full h-full px-[24px] pb-4">

            <p class="text-xs  italic text-left mb-4 w-full"> Required fields<span class="text-lg text-app-orange ml-1">*</span> </p>

            <input type="text" name="user-id" value=" <?php echo $_SESSION['user-edit'] ? $_SESSION['user-id']:"";  ?>  " hidden>

            <!-- first name -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="first-name" class="text-md font-semibold mb-1">First Name <span class="text-red-600">*</span></label>
                <input id="first-name" type="text" name="<?php   echo $_SESSION['user-edit'] ? "edit-fname" : "first-name";   ?>" class="text-app-blue py-1 px-2  w-full rounded-md"  value = "<?php  echo $_SESSION['user-edit']? $_SESSION['first-name'] :"";   ?>" required>
            </div>

            <!-- last name -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="last-name" class="text-md font-semibold mb-1">Last Name <span class="text-red-600">*</span></label>
                <input id="last-name" type="text" class="text-app-blue py-1 px-2  w-full rounded-md" name="last-name" value="<?php  echo $_SESSION['user-edit']? $_SESSION['last-name'] :"";   ?>" required>
            </div>

            <!-- email -->
            <div class="flex flex-col items-start w-full mb-2">
                <label for="email" class="text-md font-semibold mb-1">Email <span class="text-red-600">*</span></label>
                <input id="email" type="email" name="email" class="text-app-blue py-1 px-2  w-full rounded-md" value = "<?php  echo $_SESSION['user-edit']? $_SESSION['email'] :"";   ?>" required>
            </div>
            <?php

                if(!$_SESSION['user-edit']){
                    echo
                    '

                    <div class="flex flex-col items-start w-full mb-2">
                        <label for="password" class="text-md font-semibold mb-1">Password <span class="text-red-600">*</span></label>
                        <input id="password" type="password" name="password" class="text-app-blue py-1 px-2  w-full rounded-md"   pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  required>
                    </div>


                    <div class="flex flex-col items-start w-full mb-2">
                        <label for="c-password" class="text-md font-semibold mb-1">Confirm Password <span class="text-red-600">*</span></label>
                        <input id="c-password" type="password" name="c-password" class="text-app-blue py-1 px-2  w-full rounded-md"  pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  required>
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
            <button class="bg-app-blue text-app-orange w-full py-2 my-3 uppercase rounded-md">Submit</button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['user-edit'] = false;
?>