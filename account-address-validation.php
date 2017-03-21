<?php
include("bd-connect.php");
//Vérification de l'adresse
if(isset($_SESSION['user-id']) and isset($_POST['adresse'])){
    $sql = "UPDATE personne SET adresse = ? WHERE id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si",$address,$id);

    $id = $_SESSION['user-id'];
    $address = $_POST['adresse'];

    $stmt->execute();

    $_SESSION['user-adresse'] = $address;
    $_SESSION['toast']="address-changed";
    $redirect = "account-infos";
}
else{
    $_SESSION['toast']="changed-failed";
    $redirect = "account-infos";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
