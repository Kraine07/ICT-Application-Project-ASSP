<?php
if(!isset($_SESSION)){
    session_start();
}
if($_SESSION['patron-view']){
    echo '
        <footer class="h-auto bg-app-blue w-full bottom-0 flex flex-col justify-around">
            <a href="main.php" class="h-[100px] flex justify-center">
                <img src="./img/logo_light.png" alt="logo" class="h-[100px] pt-4  object-contain">
            </a>
            <div class="w-full text-gray-200 flex flex-col">
                <button id="login" class=" text-sm underline mt-2 mr-8 self-end">Admin Panel</button>
                <p class="text-xs w-screen text-center ">Copyright &copy; 2023 Backyard Cinema Ltd. All rights reserved.</p>
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