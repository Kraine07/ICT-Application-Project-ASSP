
<?php
include_once('./partials/head.php');
?>

<div class="h-screen w-screen bg-gray-700 p-4">
    <h1 class="text-4xl text-center text-slate-200 font-light pb-12">Initial Setup</h1>
    <div class="flex  justify-around items-center w-4/5 h-4/5 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 max-h-[480px] p-4 ">

        <div class="flex flex-col justify-between h-full w-1/3">
            <img class="h-full object-contain" src="./img/kisspng-clapperboard-animation-presentation-clapping-clip-movie-theatre-5ab8ef37f26f56.826720561522069303993.png" alt="">
        </div>

        <div class="h-full w-1/3">
            <form class="flex flex-col justify-between items-center h-full w-full" action="" method="post">
                <!-- Administrator details -->
                <div class="w-4/5">
                    <p class="text-xl text-white pt-4 mb-2 font-light">Administrator's information</p>
                    <input type="text" name="f-name"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* First Name" required>
                    <input type="text" name="l-name"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Last Name" required>
                    <input type="email" name="email"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Email" required>
                    <input type="password" name="password"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Password" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase." required>
                    <input type="password" name="c-password"  class=" w-full rounded-sm block mb-2 px-[8px]" placeholder="* Confirm Password" required>
                </div>

                <!-- Screen names -->
                <div class="w-4/5">
                    <p class="text-xl text-white  pt-4 mb-2 font-light">Cinema/Screen Names</p>
                    <input type="text" name="screen-1"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" required>
                    <input type="text" name="c-password"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" required>
                    <input type="text" name="c-password"  class="w-full  rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" required>
                    <input type="text" name="c-password"  class="w-full rounded-sm block mb-2 px-[8px]" placeholder="* Screen name" required>
                </div>

                <button class="bg-amber-600 text-white font-semibold rounded-full w-4/5 py-1 mt-2">Submit</button>

            </form>
        </div>
    </div>
</div>


<?php
include_once('./partials/footer.php');
?>