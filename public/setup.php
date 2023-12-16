
<?php
include_once('./partials/head.php');
?>

<div class="h-screen w-screen bg-blue-950 p-8">
<h1 class="text-4xl text-center text-slate-200 font-light pb-12">Initial Setup</h1>
    <div class="flex flex-col justify-start items-center bg-blu w-4/5 h-4/5 mx-auto ">
        <div class=" h-full w-full">
            <div class="flex justify-center h-full w-full">
                <div class="flex flex-col justify-between h-full w-1/3">
                    <span class="text-slate-200 my-2 ">Please enter the required details to create an administrator along with the screen/cinema names.</span>
                    <img class="h-2/3 object-contain" src="./img/kisspng-clapperboard-animation-presentation-clapping-clip-movie-theatre-5ab8ef37f26f56.826720561522069303993.png" alt="">
                </div>

                <div class="h-full w-2/3">
                    <form class="h-full w-full" id="setup" action="" method="post">
                        <!-- Administrator details -->
                        <div class="flex flex-col justify-between  h-full w-full ">
                            <div class="flex justify-center w-full">
                                <label class=" text-slate-200 pr-4 text-right w-2/5" for="f-name"><span class="text-lg text-amber-500">* </span>First Name</label>
                                <input type="text" name="f-name" id="f-name" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <span for="l-name" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Last Name</span>
                                <input type="text" name="l-name" id="l-name" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <label for="email" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Email</label>
                                <input type="email" name="email" id="email" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <label for="password" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Password</label>
                                <input type="password" name="password" id="password" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <label for="c-password" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Confirm Password</label>
                                <input type="password" name="c-password" id="c-password" class=" w-3/5 rounded-sm" required>
                            </div>


                            <div class="flex  justify-center">
                                <label for="screen-1" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Screen 1</label>
                                <input type="text" name="c-password" id="c-password" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <label for="c-password" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Screen 2</label>
                                <input type="text" name="c-password" id="c-password" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-center">
                                <label for="c-password" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Screen 3</label>
                                <input type="text" name="c-password" id="c-password" class=" w-3/5 rounded-sm" required>
                            </div>
                            <div class="flex  justify-between">
                                <label for="c-password" class=" text-slate-200 pr-4 text-right w-2/5"><span class="text-lg text-amber-500">* </span>Screen 4</label>
                                <input type="text" name="c-password" id="c-password" class=" w-3/5 rounded-sm" required>
                            </div>
                            <button form="setup" class="bg-amber-400 rounded-full w-3/5 py-1 self-end ml-6">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once('./partials/footer.php');
?>