<?php
include("bd-connect.php");
if(isset($_SESSION['user-id']) and isset($_POST['nom']) and
    isset($_POST['prenom'])){
    $sql = "UPDATE personne SET nom = ?, prenom = ? WHERE id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss",$nom,$prenom,$id);

    $id = $_SESSION['user-id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $stmt->execute();

    $_SESSION['user-prenom'] = $prenom;
    $_SESSION['user-nom'] = $nom;
    $_SESSION['toast']="name-changed";
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
