<?php
if(!isset($_SESSION)){
    session_start();
}


?>


<!--  User form modal window -->
<div id="user-form" class="absolute top-0 left-0 bg-[#838383cc]  w-full h-full    <?php echo $_SESSION['user-edit'] ? "": "hidden" ?>   " >
    <div class="absolute flex flex-col items-center  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[400px] w-[300px] border-2 border-blue-950 bg-slate-300" >
        <h1 class="text-white text-lg text-left bg-blue-950 w-full px-[24px] py-2"><?php echo $_SESSION['user-edit']? "Edit": "New";?> User
            <button class="float-right inline-block" id="close-user-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </h1>
        <p class="text-xs  text-red-500 italic text-right w-full px-[24px]"><span class="text-lg">*</span> Required fields </p>
        <!-- user form -->
        <form action="index.php" method="post" class="flex flex-col justify-between items-start w-full h-full p-[24px]">
        
            <input type="text" name="user-id" value=" <?php echo $_SESSION['user-edit'] ? $_SESSION['user-id']:"";  ?>  " hidden>

            <!-- first name -->
            <div class="flex flex-col items-start">
                <label for="start" class="text-md font-semibold mb-1">First Name <span class="text-red-600">*</span></label>
                <input id="start" type="text" name="first-name" class="py-1 border border-slate-200 w-full bg-white" value = "<?php  echo $_SESSION['user-edit']? $_SESSION['first-name'] :"";   ?>" required>
            </div>

            <!-- last name -->
            <div class="flex flex-col items-start">
                <label for="end" class="text-md font-semibold mb-1">Last Name <span class="text-red-600">*</span></label>
                <input id="end" type="text" class="py-1 border border-slate-200 w-full bg-white" name="last-name" value="<?php  echo $_SESSION['user-edit']? $_SESSION['last-name'] :"";   ?>" required>
            </div>

            <!-- email -->
                        <div class="flex flex-col items-start">
                <label for="start" class="text-md font-semibold mb-1">Email <span class="text-red-600">*</span></label>
                <input id="start" type="email" name="email" class="py-1 border border-slate-200 w-full bg-white" value = "<?php  echo $_SESSION['user-edit']? $_SESSION['email'] :"";   ?>" required>
            </div>

            <!-- role -->
            <?php
            $attr = '';
            echo `
            <select name="role" id="role" class="text-md font-semibold mb-1" required>
                <option  hidden>Choose role</option>
                <option class='py-1 ' value="admin"`.$_SESSION['role'] === 'admin' && $_SESSION['user-edit'] ? 'selected' : '' .` > Admin </option>
                <option class='py-1 ' value="supervisor" >Supervisor</option>
            </select>`
            ?>
            <!-- submit button -->
            <button class="bg-blue-950 text-white w-full p-2">Submit</button>
        </form>
    </div>

</div>


<!-- reset session variable to prevent form from opening upon page refresh -->
<?php
    $_SESSION['user-edit'] = false;
?>