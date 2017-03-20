<?php
if(isset($_POST['email'])) {
    include("bd-connect.php");
    include("meta.php");
    require 'phpmailer/PHPMailerAutoload.php';
    $isnew = 1;
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = "";
    }
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $password = randomPassword();
    if ($id != "") {
        $sql = "UPDATE personne SET email=?,prenom=?,nom=?,telephone=?,adresse=? WHERE id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $email, $prenom, $nom, $telephone, $adresse, $id);
        $stmt->execute();
        $_SESSION['toast'] = "client-mod";
        $redirect = "admin-client-list";
    } else {
        $sql = "select id from personne where email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($checkemail);
        if ($stmt->fetch()) {
            $_SESSION['toast'] = "client-ajout-existe";
            $redirect = "admin-client";
            $stmt->free_result();
            $stmt->close();
        } else {
            //Envoie email
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_GLOBAL['mail-user'];
            $mail->Password = $_GLOBAL['mail-psw'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom($_GLOBAL['mail-user'], 'La Boîte à Bouf');
            $mail->addAddress($email);
            $mail->addReplyTo($_GLOBAL['mail-user'], 'La Boîte à Bouf');
            $mail->isHTML(true);
            $mail->Subject = 'Votre inscription à la ' . $_GLOBAL['entreprise'];
            $mail->CharSet = 'UTF-8';
            $mail->Body = "Bienvenue chez la " . $_GLOBAL['entreprise'] . ", <br> voici le mot de passe qui vous a été généré:<br/><b>$password</b><br>Vous pouvez le modifier à tout moment en vous connectant à votre compte sur notre site web.<br>Merci, et au plaisir de vous revoir.";
            $password = md5($password);
            if (!$mail->send()) {
                $_SESSION['toast'] = "client-ajout-erreurmail";
            }
            $sql = "INSERT INTO personne (prenom,nom,telephone,email,passe,isnew) values (?,?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sssssi", $prenom, $nom, $telephone, $email, $password, $isnew);
            $stmt->execute();
            $_SESSION['toast'] = "client-ajout";
            $redirect = "admin";
        }
    }
    $stmt->free_result();
    $stmt->close();
}
elseif(isset($_GET['idout'])){
    include("bd-connect.php");
    include("meta.php");
    $idout = (integer)$_GET['idout'];
    $sql = "UPDATE personne SET isnew=2 WHERE id=?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idout);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "client-out";
        $redirect = "admin-client-list";
    }
    $stmt->free_result();
    $stmt->close();
}
elseif(isset($_GET['idin'])){
    include("bd-connect.php");
    include("meta.php");
    $idin = (integer)$_GET['idin'];
    $sql = "UPDATE personne SET isnew=1 WHERE id=?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $idin);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "client-in";
        $redirect = "admin-client-list";
    }
    $stmt->free_result();
    $stmt->close();
}
else
    {
        $_SESSION['toast'] = "erreur-client";
        $redirect = "admin-client-list";
    }
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php if(isset($redirect)){ echo $redirect; } else { echo "home"; } ?>'"/>
</head>
</html>
<?php
function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
?>