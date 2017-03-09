<?php
$_GLOBAL['couleur1a'] = "brown";
$_GLOBAL['couleur1b'] = "lighten-1";
$_GLOBAL['couleur2a'] = "grey";
$_GLOBAL['couleur2b'] = "lighten-2";
$_GLOBAL['couleur-menu-1a'] = "grey";
$_GLOBAL['couleur-menu-1b'] = "darken-4";
$_GLOBAL['couleur-menu-2a'] = "orange";
$_GLOBAL['couleur-menu-2b'] = "darken-4";
$_GLOBAL['couleur-menu-3a'] = "white";
$_GLOBAL['couleur-menu-3b'] = "";
$_GLOBAL['couleur-menu-4a'] = "white";
$_GLOBAL['couleur-menu-4b'] = "";
$_GLOBAL['couleur-menu-5a'] = "black";

$_GLOBAL['jour-limite-commander'] = 5; //vendredi = 5, quand sera desactiver la commande
$_GLOBAL['jour-limite-commander-text'] = "friday"; //anglais pour datetime
$_GLOBAL['jour-debut-commander-text'] = "monday"; //anglais pour datetime
$_GLOBAL['jour-debut-commander'] = 1; //lundi = 1, quand sera ouvert
$_GLOBAL['entreprise'] = "Boîte à Bouf";
$_GLOBAL['mail-user'] = 'laboiteabouf@outlook.com';
$_GLOBAL['mail-psw'] = 'Dodgecolt1984';
$_GLOBAL['dirimg'] = "upload/";
setlocale(LC_ALL, 'fr_CA.utf8', 'fra');

$fichier = explode("/", $_SERVER['PHP_SELF']);
$fichier = $fichier[count($fichier)-1];

$sql = "SELECT * FROM w_pages_contenu WHERE CONCAT(fichier,'.php') LIKE '$fichier'";
$result = $mysqli->query($sql);
$page = $result->fetch_assoc();
?>

<meta name='description' content='<?php echo $_GLOBAL['entreprise']; ?> est un service traiteur qui offre des plats cuisinés maison.'/>
<meta name='keywords' content='Boîte, à, Bouf, bouffe, traiteur, plats, cuisine, maison'/>
<meta name='author' content='Jose Ouellet et Guillaume Prudhomme'/>
<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
<title><?php echo $page['titre'] ?> - <?php echo $_GLOBAL['entreprise']; ?></title>

<!--mettre les valeurs meta (copier-coller) dans les fichiers independants index.html et index.php-->