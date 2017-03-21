<?php
if(isset($_POST['accepter'])){
    setcookie("cookiesaccepted",true,time()+31556926);//cookies accepted
    echo "<meta http-equiv=\"refresh\" content=\"0;URL='#'>";
}
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
$fichier = explode("/", $_SERVER['PHP_SELF']);
$fichier = $fichier[count($fichier)-1];
if(isset($_COOKIE['cookiesaccepted'])){
    session_start();
}
?>