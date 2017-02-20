<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php include_once("meta.php"); ?>
        <link rel="stylesheet" type="text/css" href="css/materialize.css">
        <script src="js/materialize.js"></script>
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