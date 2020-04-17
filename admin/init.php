<?php 
    // routers
    
    $js = "layouts/backend.js";
    $css = "layouts/css/style.css";
    $login = "ToDB/login.php";
    $tem = "includes/tem/";
    $lang = "includes/langs/";
    $fanc = "includes/func/";

    // important files
    include $fanc . "functions.php";
    include $lang . "English.php";
    include $tem . "header.php";
    

    // include navbar on all site not have $Nonav varible
    if(!isset($Nonav))
    {
        include "includes/tem/nav.php";
    }


    // logout
    if(isset($_GET['action']) && $_GET['action'] == "logout")
    {
        session_unset();
        session_destroy();
        header("Location: index.php" );
    }
?>