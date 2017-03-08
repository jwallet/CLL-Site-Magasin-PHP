<?php
if(isset($_POST['email'])) {
    include("bd-connect.php");
    require 'phpmailer/PHPMailerAutoload.php';
    $isnew = 1;
    //verification si tous les champs ont été renseignés, pu besoin de l'indiquer comme "is new"
    if(isset($_POST['prenom'])and isset($_POST['nom']) and isset($_POST['telephone'])){
        $isnew = 0;
    }
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = randomPassword();
    //Envoie email
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_GLOBAL['mail-user'];
    $mail->Password = $_GLOBAL['mail-psw'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($_GLOBAL['mail-user'], 'Mailer');
    $mail->addAddress($email);
    $mail->addReplyTo($_GLOBAL['mail-user'], 'Info');
    $mail->isHTML(true);
    $mail->Subject = 'Votre inscription à la ' . $_GLOBAL['entreprise'];
    $mail->CharSet = 'UTF-8';
    $mail->Body    = "Bienvenue chez la " . $_GLOBAL['entreprise'] . ", <br> voici le mot de passe qui vous a été généré: <b> $password </b>. <br>Vous pouvez le modifier à tout moment en vous connectant à votre compte sur notre site web.<br>Merci, et au plaisir de vous revoir.";
    $password = md5($password);
    $sql = "select id from personne where email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($checkemail);
    if ($stmt->fetch()) {
        $_SESSION['toast'] = "client-ajout-existe";
        $redirect = "admin-client-ajout";
        $stmt->free_result();
    } else {
        $sql = "INSERT INTO personne (prenom,nom,telephone,email,passe,isnew) values (?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $prenom, $nom, $telephone, $email, $password, $isnew);
        $stmt->execute();
        $_SESSION['toast'] = "client-ajout";
        $redirect = "admin";
    }

    if(!$mail->send()) {
        $_SESSION['toast'] = "client-ajout-erreurmail";
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