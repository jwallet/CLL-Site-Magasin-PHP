<?php
if(isset($_POST['email']) and isset($_POST['password'])){
    include("bd-connect.php");

    $sql = "SELECT id, prenom, nom, telephone, adresse, isadmin, isnew FROM personne WHERE email LIKE ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss",$email,$passe);

    $email = $_POST['email'];
    $passe = md5($_POST['password']);

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
            if(!$_SESSION['user-isnew']) {
                $redirect = "menu"; //une fois connecte un user, il va shopper
                setcookie("cookiesaccepted",true,time()+31556926);//cookies accepted
            }
            else{
                $redirect = "account-first-access"; //si premier acces, va remplir tes infos.
            }
        }
        else{
            setcookie("cookiesaccepted",true,time()+31556926);//cookies accepted
            $redirect = 'admin'; //une fois connecte un admin, il va au dashboard admin
        }
    }
    else{
        unset( $_SESSION['user-online']);
        unset( $_SESSION['user-id']);
        unset( $_SESSION['user-email']);
        unset( $_SESSION['user-passe']);
        unset( $_SESSION['user-prenom']);
        unset( $_SESSION['user-nom']);
        unset( $_SESSION['user-telephone']);
        unset( $_SESSION['user-adresse']);
        unset( $_SESSION['user-isadmin']);
        unset( $_SESSION['user-isnew']);
        $_SESSION['toast'] = "login-failed";
        $redirect = "connect";
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
