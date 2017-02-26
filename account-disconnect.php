<?php
session_start();
unset( $_SESSION['user-online']);
unset( $_SESSION['user-id']);
unset( $_SESSION['user-email']);
unset( $_SESSION['user-passe']);
unset( $_SESSION['user-prenom']);
unset( $_SESSION['user-nom']);
unset( $_SESSION['user-telephone']);
unset( $_SESSION['user-adresse']);
unset( $_SESSION['user-isadmin']);
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='home.php'"/>
</head>
</html>
