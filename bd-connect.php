<?php
$_GLOBAL['mail-user'] = 'robot.laboiteabouf@gmail.com';
$_GLOBAL['mail-psw'] = 'robotadmin123';
$_GLOBAL['mail-cc'] = 'laboiteabouf@outlook.com';
//iP0AxxQjTpQR2lwO -- password
$mysqli = new mysqli("localhost", "equipe5h17", "rogue-art","equipe5h17","22");
//$mysqli = new mysqli("localhost", "mon-usager-SQL", "iP0AxxQjTpQR2lwO","boitebouf","22");
if ($mysqli -> connect_error) {
    die('Impossible de se connecter à la bd:' . $mysqli->connect_error);
}
$mysqli->set_charset("UTF8");
session_start();
?>