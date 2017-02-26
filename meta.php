<?php
$fichier = explode("/", $_SERVER['PHP_SELF']);
$fichier = $fichier[count($fichier)-1];

$sql = "SELECT * FROM w_pages_contenu WHERE CONCAT(fichier,'.php') LIKE '$fichier'";
$result = $mysqli->query($sql);
$page = $result->fetch_assoc();
?>

<meta name='description' content='aa'/>
<meta name='keywords' content='aa'/>
<meta name='author' content='Jose Ouellet et Guillaume Prudhomme'/>
<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
<title><?php echo $page['titre'] ?> - La Boîte à Bouf</title>

<!--mettre les valeurs meta (copier-coller) dans les fichiers independants index.html et index.php-->