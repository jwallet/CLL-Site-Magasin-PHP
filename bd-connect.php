<?php
//iP0AxxQjTpQR2lwO -- password
    //$mysqli = new mysqli("localhost", "equipe5h17", "rogue-art","equipe5h17","22") or die("Impossible de se connecter à la base de donnée");
    $mysqli = new mysqli("localhost", "mon-usager-SQL", "iP0AxxQjTpQR2lwO", "boitebouf");
    if ($mysqli -> connect_error) {
        die('Impossible de se connecter à la bd:' . $mysqli->connect_error);
    }
    $mysqli->set_charset("UTF8");
?>