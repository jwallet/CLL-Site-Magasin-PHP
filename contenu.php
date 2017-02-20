<?php
$page = explode("/", $_SERVER['PHP_SELF']);
switch ($page[count($page)-1]){
    case 'accueil.php';
        include_once("accueil-contenu.php");
        break;

    case 'admin.php';
        include_once("admin-contenu.php");
        break;
}?>