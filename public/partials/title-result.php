
<div class="flex flex-col items-center w-full">
    <form action="index.php" method="post" class="w-full">
        <input name="movie-id" value= <?php echo $result->{'id'};?> hidden>
        <button class="block bg-gray-200 hover:bg-gray-400 hover:font-semibold py-1 px-8 mx-auto my-[6px] rounded-md cursor-pointer w-2/3 "><?php echo $result->{'title'}; ?></button>
    </form>
</div>

