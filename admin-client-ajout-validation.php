<?php
include("bd-connect.php");
if(isset($_POST['email'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    //Ajouter l'envoie du mail ici
    $password = md5($email);
    $sql = "INSERT INTO personne (prenom,nom,telephone,email,passe) values (?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $prenom, $nom, $telephone, $email, $password);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "client-ajout";
        $redirect = "admin";
    }
    $stmt->close();
//    else
//    {-
//        $_SESSION['toast'] = "plat-ajout-erreur";
//        $redirect = "admin-plat-ajout";
//    }
//
//}
//else
//{
//    $_SESSION['toast'] = "plat-ajout-erreur";
//    $redirect = "admin-plat-ajout";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>