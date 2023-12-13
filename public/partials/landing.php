<div class="container  h-screen w-screen mx-auto flex-col justify-center relative overflow-hidden">

    <!-- Login form modal -->
    <div id="login-form" class="bg-[#ffffffbb] absolute top-0 left-30 z-50 hidden w-screen h-screen">
        <div id="" class="shadow-custom bg-zinc-200  w-1/5 p-8 top-12 right-12 absolute z-50">

            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-14 h-14 mx-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" class="text-gray-700" />
                </svg>
                <h2 class="  text-2xl  text-gray-900">Sign in</h2>
            </div>


            <div class="sm:mx-auto sm:w-full sm:max-w-xs">
                <form action="login.php" method="post">
                    <!-- Email input -->
                    <div class="mt-2">
                        <div class="">
                            <input placeholder="Email (required)" id="email" name="email" type="text" autocomplete="email" required autofocus class="block w-full rounded-md border-0 outline-0 py-0.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-gray-700 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Password input -->
                    <div class="mt-2">
                        <div class="">
                            <input placeholder="Password (required)" id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 outline-0 py-0.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-gray-700 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-2">
                        <button type="submit" name="login" class="flex w-full justify-center rounded-full bg-gray-700 px-3 py-0.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-900">Sign in</button>
                    </div>
                    <div class="mt-2">
                        <div  id="login-cancel" class="flex w-full justify-center rounded-full border border-gray-700 px-3 py-0.5 text-sm font-semibold leading-6 text-gray-700 shadow-sm hover:bg-gray-300 cursor-pointer">Cancel</div>
                    </div>
                </form>
            </div>

        </div>
    </div>


    <!-- Page Content -->
    <div class="relative overflow-hidden container">
        <div class="flex  h-full w-screen">
            <div class="w-2/5 h-screen">
                <img src="./img/cinema-4398725_1280.png" alt="" class="h-full object-cover">
                <div>
                    <img src="./img/kisspng-cinema-film-movie-theatre-5ac068632302c2.1016541515225590751434.png" alt="" class="h-2/3 object-contain absolute -bottom-20  z-20 ">
                </div>
            </div>

            <div class="absolute w-11/12 aspect-square rounded-full bg-blue-950 -right-1/4 self-center border-gray-200 border-2 "></div>

            <div class=" w-3/5  flex flex-col justify-evenly items-end z-10">
                <button id="login" class=" bg-gray-300 w-1/4 rounded-l-full justify-self-start">Admin Panel</button>
                <div class=" flex flex-col items-end mr-12 justify-between">
                    <h1 class="text-8xl text-gray-300 font-light text-right w-3/5">Backyard Cinema</h1>
                    <a href="main.php" class="bg-red-900 text-gray-300 text-center text-xl font-semibold py-2 w-3/5 rounded-full my-8">Enter
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>