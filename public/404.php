<?php

session_start();
$_SESSION['patron-view'] = true;

require_once('./partials/head.php');
?>
<div class='background-404'>
    <div class="backdrop">
        <div>
            <img src="./img/404-image.png" alt="Oops!">
        </div>
        <div class ='text-404'>
            <h1>PAGE NOT FOUND</h1>
            <p>The page you are trying to access is unavailable.
                We are working hard to resolve this issue in short order.
                Please try again later.
            </p>
        </div>
    </div>
</div>
<?php

require_once('./partials/footer.php');


?>