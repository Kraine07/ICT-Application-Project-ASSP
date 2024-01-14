<?php
if($_SESSION['patron-view']){
    echo '
        <footer class="h-[50px] bg-black w-full relative">
            <div class="text-white ">
                <button id="login" class=" text-sm underline float-right mt-2 mr-8">Admin Panel</button>
                <p class="text-xs w-screen text-center absolute bottom-2 left-0">Copyright &copy; 2023 Backyard Cinema Ltd. All rights reserved.</p>
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