<?php
$page = explode("/", $_SERVER['PHP_SELF']);
switch ($page[count($page)-1]){
    case 'accueil.php';
        include_once("accueil-contenu.php");
        break;
    case 'admin.php';
        include_once("admin-contenu.php");
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
}?>