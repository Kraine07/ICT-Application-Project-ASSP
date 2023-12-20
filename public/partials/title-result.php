
<div class="flex flex-col items-center w-full">
    <form action="index.php" method="post" class="w-full">
        <input name="movie-id" value= <?php echo $result->{'id'};?> hidden>
        <button class="block bg-gray-200 py-1 px-8 mx-auto my-[4px] rounded-md cursor-pointer w-5/6"><?php echo $result->{'title'}; ?></button>
    </form>
</div>

