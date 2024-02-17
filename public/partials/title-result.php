
<div class="flex flex-col items-center w-full">
    <form action="index.php" method="post" class="w-full">
        <input name="movie-id" value= <?php echo $result->{'id'};?> hidden>
        <button class="block border border-app-secondary bg-app-secondary hover:border-gray-200  duration-300 hover:scale-105 py-1 px-8 mx-auto my-1 rounded-md cursor-pointer w-2/3 "><?php echo $result->{'title'}; ?> <span class="italic mr-2">  (<?php echo date_format(date_create($result->{'release_date'}),'Y');  ?>)  </span> </button>
    </form>
</div>

