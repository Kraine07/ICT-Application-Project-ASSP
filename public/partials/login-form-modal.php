

<div id="login-form" class="bg-app-modal absolute top-0 left-30 z-50 hidden w-full h-screen">
    <div id="" class=" bg-slate-200  w-[300px] p-8 top-12 right-12 absolute z-50">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 22" stroke-width="0.7" stroke="currentColor" class="w-16 h-16 mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" class="text-gray-700 font-light" />
            </svg>
            <h2 class="text-3xl  text-gray-900  font-light">Sign in</h2>
            <p class="text-xs  text-red-500 italic inline float-right"><span class="text-lg">*</span> Required fields </p>
        </div>


        <div class="sm:mx-auto sm:w-full sm:max-w-xs">
            <form action="login.php" method="post">
                <!-- Email input -->
                <div class="mt-2">
                    <div class="">
                        <label for="email">Email <span class="text-lg text-red-500">*</span></label>
                        <input required id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 outline-0 py-0.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-gray-700 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Password input -->
                <div class="mt-1">
                    <div class="">
                    <label for="password">Password <span class="text-lg text-red-500">*</span></label>
                        <input required  id="password" name="password" type="password" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with at least one number and uppercase."  class="block w-full rounded-md border-0 outline-0 py-0.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-gray-700 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button type="submit" name="login" class="flex w-full justify-center rounded-full bg-blue-900 px-3 py-0.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-950">Sign in</button>
                </div>
                <div class="mt-2">
                    <div  id="login-cancel" class="flex w-full justify-center rounded-full border border-gray-700 px-3 py-0.5 text-sm font-semibold leading-6 text-gray-700 shadow-sm hover:bg-gray-300 cursor-pointer">Cancel</div>
                </div>
            </form>
        </div>

    </div>
</div>