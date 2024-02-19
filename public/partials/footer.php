<?php
if(!isset($_SESSION)){
    session_start();
}

// show only in patron's views
if($_SESSION['patron-view']){
    echo '
        <footer class="h-auto w-full bottom-0 flex flex-col justify-around   bg-app-blue">
            <a href="main.php" class="h-[130px] flex justify-center">
                <img src="./img/logo_new_orange.png" alt="logo" class="h-[120px] pt-4  object-contain">
            </a>
            <div class="w-full text-gray-200 flex flex-col">
                <button id="login" class=" italic text-sm bg-app-tertiary my-4 inline py-1 px-4 rounded-md self-center  ">Admin Panel</button>
                <p class="text-xs w-screen text-center pb-1 ">Copyright &copy; 2023 Backyard Cinema Ltd. All rights reserved.</p>
            </div>
        </footer>
    ';
}

?>
        </div>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="script.js"></script>
    </body>
</html>