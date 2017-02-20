<?php
$page = $_SERVER['PHP_SELF'];
switch ($page){
    case 'accueil.php';
        $title= 'titre index du site';
        $description = 'description index du site';
        $keywords = 'key, word, to, add';
 break;

    case 'admin.php';
        $title= 'titre a propos de';
        $description = 'description a propos de';
        $keywords = 'key, word, to, add';
 break;
}?>