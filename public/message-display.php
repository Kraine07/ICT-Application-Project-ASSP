<?php

// turn off error reports
// error_reporting(0);



function showErrorMessage($message, $redirect="index"){
    echo '
    <div class="h-screen w-screen bg-app-modal  absolute z-30">
        <div class="w-[400px] h-auto  absolute z-30  left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">
            <div class=" bg-gray-200 animate-zoom-in border border-red-500 " >
                <h2 class="text-xl bg-red-500 text-gray-200 mb-4 p-2 px-4 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    Error
                </h2>
                <div class="flex flex-col m-6">
                    <span class=" text-sm mb-4  block">'. $message . ' </span>
                    <a href="'.$redirect.'.php" class="block text-sm text-gray-200 text-center font-semibold self-end cursor-pointer  bg-red-500 py-1 w-[100px] rounded-full">OK</a>
                </div>
            </div>
        </div>
    </div>

    ';

}




function showSuccessMessage($message, $redirect="index"){
    echo '
    <div class="h-screen w-screen bg-app-modal absolute z-30">
        <div class="w-[400px] h-auto absolute z-30 left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
            <div class="bg-gray-200 animate-zoom-in border border-green-500 ">
                <h2 class="text-xl bg-green-500 text-gray-200 mb-4 p-2 px-4 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    Success
                </h2>
                <div class="flex flex-col m-6">
                    <span class=" text-sm mb-4  block">'. $message . ' </span>
                    <a href="'.$redirect.'.php" class="block text-sm text-gray-200 text-center font-semibold self-end cursor-pointer  bg-green-500 py-1 w-[100px] rounded-full">OK</a>
                </div>
            </div>
        </div>
    </div>

    ';

}

?>