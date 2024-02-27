

<div id="login-form" class="bg-app-modal absolute top-0 left-30 z-50 hidden w-full h-screen">
    <div id="" class=" bg-app-tertiary  w-[300px] py-8 px-8 top-12 right-12 absolute z-50 rounded-md">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm mb-4 text-gray-200">
            <!-- Logo -->
            <img src="./img/logo_new_light.png" alt="" class=" object-contain h-16 mx-auto mb-8">
            <p class="text-xs text-gray-400 italic mt-4 w-full text-left">Required fields <span class="text-app-orange text-md ml-1">*</span></p>
        </div>


        <div class="sm:mx-auto sm:w-full sm:max-w-xs text-gray-200 text-sm">
            <form action="login.php" method="post" class="group" novalidate>
                <!-- Email input -->
                <div class="mt-2">
                    <div class="">
                        <label for="email" class="">Email <span class="text-lg  ml-1 text-app-orange">*</span></label>
                        <input required id="email" name="email" type="email" autocomplete="email" class="block w-full border-2 border-gray-200 bg-gray-200 rounded-sm text-app-blue  font-semibold  outline-none ring-0 py-1 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" placeholder="Enter email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        <span class="leading-tight mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                            Please enter a valid email address
                        </span>
                    </div>
                </div>

                <!-- Password input -->
                <div class="mt-3">
                    <div class="">
                    <label for="password" class="">Password <span class="text-lg  ml-1 text-app-orange">*</span></label>
                        <input required  id="password" name="password" type="password" pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])[A-Za-z0-9]{8,}$" title="Minimum 8 characters with uppercase, lowercase and number."  class="block w-full rounded-sm text-app-blue  font-semibold border-2 border-gray-200 bg-gray-200 outline-none ring-0 py-1 px-2 mt-1 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-blue-500    peer  invalid:[&:not(:placeholder-shown):not(:focus)]:outline-app-orange" placeholder="Enter password">
                        <span class=" leading-tight  mt-2 hidden text-xs text-app-orange peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                            Password must be 8 characters minimum with uppercase, lowercase and number.
                        </span>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-6 bg-app-blue rounded">
                    <button type="submit" name="login" class=" flex w-full justify-center rounded  px-3 py-1  text-sm font-semibold leading-6 text-app-orange border-2 border-app-blue hover:bg-blue-950 hover:border-blue-950      group-invalid:pointer-events-none group-invalid:opacity-30">Sign in</button>
                </div>
                <div class=" mt-2">
                    <div  id="login-cancel" class="flex w-full justify-center rounded border-2 border-gray-600 px-3 py-1 text-sm font-semibold leading-6 text-gray-200  cursor-pointer hover:bg-gray-600">Cancel</div>
                </div>
            </form>
        </div>

    </div>
</div>