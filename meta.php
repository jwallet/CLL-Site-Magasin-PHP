<?php
$page = explode("/", $_SERVER['PHP_SELF']);
switch ($page[count($page)-1]){
    case 'accueil.php':
        $title= 'La Boîte à Bouf';
        $description = 'description index du site';
        $keywords = 'key, word, to, add';
 break;

    case '/projet/h2017/equipe5/admin.php':
        $title= 'titre a propos de';
        $description = 'description a propos de';
        $keywords = 'key, word, to, add';
 break;
    default:
        $title= 'null';
        $description = 'null';
        $keywords = 'null';
        break;
}
echo "<meta name='description' content='" . $description . "'>";
echo "<meta name='keywords' content='" . $keywords . "'>";
echo "<meta name='author' content='Jose Ouellet et Guillaume Prudhomme'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>" . $title . " - La Boîte à Bouf</title>";
?>