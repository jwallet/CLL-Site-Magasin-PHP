<?php
$page = explode("/", $_SERVER['PHP_SELF']);
$page = $page[count($page)-1];

if(strpos($page, "shop-main.php")) {
    include_once("nav.php");
}
elseif(strpos($page, "admin")){
    //load menu admin header
}

switch ($page){
    case 'home.php';
        include_once("home-content.php");
        break;

    case 'admin.php';
        include_once("admin-content.php");
        break;
}
?>