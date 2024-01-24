<?php

$genres = "SELECT * FROM `{$database}`.`{$genre_table}`"

?>


<div class="w-screen h-screen absolute top-0 left-0 bg-app-modal">
    <form action="" class="inline-block bg-app-tertiary h-auto w-auto pb-6 text-gray-200  absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <legend class="flex justify-between items-center bg-app-blue py-2 px-8 w-full text-2xl text-left">
            <span>Edit Movie</span>
            <span class="inline-block cursor-pointer" id="close-schedule-form">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </span>
        </legend>
        <p class="mt-2">Required fields <span class="text-app-orange">*</span></p>
        <input type="text" name="id"  hidden>


        <div class=" mx-4 inline-flex flex-col justify-start items-start w-auto">

            <label for="title" class="text-lg mt-3 mb-1">Title<span class="text-app-orange">*</span></label>
            <input  class="text-app-blue font-semibold mt-3 mb-1 w-full rounded-sm focus:outline-app-blue" type="text" name="title" id="title" required/>

            <label for="plot" class="text-lg mt-3 mb-1" >Plot<span class="text-app-orange">*</span></label>
            <textarea class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue" name="plot" id="plot" cols="10" rows="4" required></textarea>

            <div class="flex justify-between w-full">

                <div class="inline-flex flex-col items-start w-2/5">
                    <label for="duration" class="text-lg mt-3 mb-1" >Duration<span class="text-app-orange">*</span></label>
                    <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue" type="text" name="duration" id="duration" required/>
                </div>

                <div class="inline-flex flex-col items-start w-2/5">
                    <label for="rating" class="text-lg mt-3 mb-1" >Rating<span class="text-app-orange">*</span></label>
                    <input class="text-app-blue font-semibold  w-full rounded-sm focus:outline-app-blue" type="text" name="rating" id="rating" required/>
                </div>

            </div>

            <label for="poster" class="text-lg mt-3 mb-1" >Poster URL<span class="text-app-orange">*</span></label>
            <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue" type="text" name="poster" id="poster" required/>

            <label for="trailer" class="text-lg mt-3 mb-1" >Trailer URL<span class="text-app-orange">*</span></label>
            <input class="text-app-blue font-semibold w-full rounded-sm focus:outline-app-blue" type="text" name="trailer" id="trailer" required/>
        </div>


        <div class="inline-flex flex-col  h-full w-auto mt-3 pl-8">
            <p class="text-lg text-left mb-2">Genres<span class="text-app-orange">*</span></p>
            <div class="grid grid-cols-2 gap-y-3 text-xs">


                <?php
                    if($result = mysqli_query($conn,$genres)){
                        while($row = mysqli_fetch_array($result)){
                            echo "
                            <div class='flex'>
                                <input type='checkbox' name='genres[]' id='{$row['genre_id']}' value='{$row['genre_id']}'>
                                <label class='ml-1' for='{$row['genre_id']}'>{$row['genre_name']}</label>
                            </div>
                            ";
                        }
                    }
                ?>

            </div>
        </div>
<button class="mt-6 py-1 bg-app-orange w-1/2 rounded-full">Submit</button>

    </form>
</div>