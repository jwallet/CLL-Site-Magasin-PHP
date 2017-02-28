<?php
if(isset($_SESSION['user-id']) and
    isset($_POST['email']) and isset($_POST['prenom']) and
    isset($_POST['nom']) and isset($_POST['telephone'])) {
    include("bd-connect.php");
    $sql = "UPDATE personne SET prenom = ?, nom = ?, telephone = ?, adresse = ?, isnew = 0 WHERE id = ? AND email LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssis",$prenom, $nom, $telephone, $adresse, $id, $email);

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $id = $_SESSION['user-id'];
    $email = $_POST['email'];

    $stmt->execute();

    $stmt->free_result();

    $sql = "SELECT id, prenom, nom, telephone, adresse, isadmin, isnew FROM personne WHERE id = ? AND email LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss",$id, $email);

    $stmt->execute();

    $stmt->bind_result($id, $prenom, $nom, $telephone, $adresse, $isadmin, $isnew);

    if($stmt->fetch()){
        $_SESSION['user-online'] = true;
        $_SESSION['user-id'] = $id;
        $_SESSION['user-email'] = $email;
        $_SESSION['user-passe'] = $passe;
        $_SESSION['user-prenom'] = $prenom;
        $_SESSION['user-nom'] = $nom;
        $_SESSION['user-telephone'] = $telephone;
        $_SESSION['user-adresse'] = $adresse;
        $_SESSION['user-isadmin'] = $isadmin;
        $_SESSION['user-isnew'] = $isnew;
        if(!$_SESSION['user-isadmin']){
            $redirect = "shop"; //une fois connecte un user, il va shopper
        }
        else{
            $redirect = 'admin'; //une fois connecte un admin, il va au dashboard admin
        }
    }

    $stmt->free_result();
    $stmt->close();
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php if(isset($redirect)){ echo $redirect; } else { echo "home"; } ?>'"/>
</head>
</html>
