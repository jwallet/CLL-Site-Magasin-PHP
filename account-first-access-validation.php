<?php
if(isset($_POST['id']) and
    isset($_POST['new1password']) and isset($_POST['new2password']) and
    isset($_POST['email']) and isset($_POST['prenom']) and
    isset($_POST['nom']) and isset($_POST['telephone'])) {
    include("bd-connect.php");
    session_start();
    $sql = "UPDATE personne SET passe = ?, prenom = ?, nom = ?, telephone = ?, adresse = ?, isnew = 0 WHERE id = ? AND email LIKE ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssiss",$passe, $prenom, $nom, $telephone, $adresse, $id, $email, $oldpass);

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $oldpass = $_SESSION['user-passe'];
    $passe = md5($_POST['new2password']);
    $telephone = $_POST['telephone'];
    if(isset($_POST['adresse'])) {
        $adresse = $_POST['adresse'];
    }
    else{
        $adresse = "";
    }
    $id = (integer)$_POST['id'];
    $email = $_POST['email'];

    $stmt->execute();

    $stmt->free_result();

    $sql = "SELECT id, prenom, nom, telephone, adresse, isadmin, isnew FROM personne WHERE id = ? AND email LIKE ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("iss",$id, $email, $passe);

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
        setcookie("cookiesaccepted",true,time()+31556926);//cookies accepted
        $redirect = "menu"; //une fois connecte un user, il va shopper
    }
    else{
        if(isset($_SESSION['user-online'])) {
            unset($_SESSION['user-online']);
            unset($_SESSION['user-id']);
            unset($_SESSION['user-email']);
            unset($_SESSION['user-passe']);
            unset($_SESSION['user-prenom']);
            unset($_SESSION['user-nom']);
            unset($_SESSION['user-telephone']);
            unset($_SESSION['user-adresse']);
            unset($_SESSION['user-isadmin']);
            unset($_SESSION['user-isnew']);
        }
        $redirect = "account-first-access";
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
