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
    case 'admin-majclient.php';
        include_once("admin-majclient-contenu.php");
        break;
    case 'admin-formcommande.php';
        include_once("admin-formcommande-contenu.php");
        break;
    case 'admin-menu.php';
        include_once("admin-menu-contenu.php");
        break;
    case 'admin-majcommande.php';
        include_once("admin-majcommande-contenu.php");
        break;
}
?>