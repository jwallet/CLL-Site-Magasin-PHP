<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php include_once("meta.php");
            echo "<meta name='description' content='" . $description . "'>";
            echo "<meta name='keywords' content='" . $keywords . "'>";
            echo "<meta name='author' content='Jose Ouellet et Guillaume Prudhomme'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>" . $title . " - La Boîte à Bouf</title>";
        ?>
        <link rel="stylesheet" type="text/css" href="/css/materialize.css">
    </head>
    <body>

        <?php
            echo "<section class=\"header\">";
            include_once("header.php");
            echo "</section>";
            echo "<h1>" . $title . "</h1>";
            echo "<section class=\"menu\">";
            include_once("menu.php");
            echo "</section>";
            echo "<section class=\"content\">";
            include_once("contenu.php");
            echo "</section>";
            echo "<section class=\"footer\">";
            include_once("footer.php");
            echo "</section>";
        ?>

    </body>
</html>