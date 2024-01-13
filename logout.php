<?php
session_start();

if(
        isset($_SESSION['useremail'])
    &&  !empty($_SESSION['useremail'])
){
    
    unset($_SESSION['useremail']); ///deleting the session stored value
    session_destroy();
    
    ?>
        <script>location.assign('login.php')</script>
    <?php
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}

?>
