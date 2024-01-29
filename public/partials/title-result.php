
<div class="flex flex-col items-center w-full">
    <form action="index.php" method="post" class="w-full">
        <input name="movie-id" value= <?php echo $result->{'id'};?> hidden>
        <button class="block border border-app-secondary bg-app-secondary hover:border-gray-200  py-1 px-8 mx-auto my-2 rounded-md cursor-pointer w-2/3 "><?php echo $result->{'title'}; ?></button>
    </form>
</div>

