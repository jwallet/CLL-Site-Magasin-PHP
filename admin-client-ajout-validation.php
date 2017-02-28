<?php
include("bd-connect.php");
require 'phpmailer/PHPMailerAutoload.php';
if(isset($_POST['email'])) {
    $isnew = 1;
    //verification si tous les champs ont été renseignés, pu besoin de l'indiquer comme "is new"
    if(isset($_POST['prenom'])and isset($_POST['nom']) and isset($_POST['telephone'])){
        $isnew = 0;
    }
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = uniqid("BB",false);
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
    $mail->Subject = 'Votre inscription à la Boîte À Bouf';
    $mail->Body    = "Bienvenue chez la Boîte À Bouf, <br> <br> voici le mot de passe qui vous a été généré: <b> $password </b>. <br>Vous pouvez le modifier à tout moment en vous connectant à votre compte sur notre site web.<br>Merci, et au plaisir de vous revoir.";
    //$password = md5($password);
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
        $stmt->bind_param("sssss", $prenom, $nom, $telephone, $email, $password, $isnew);
        $stmt->execute();
        $_SESSION['toast'] = "client-ajout";
        $redirect = "admin";
    }
    $stmt->close();
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
<?php
//    $to = 'misterj.20@hotmail.com';
//    $subject = 'Confirmation de votre inscription à La Boîte À Bouf';
//    $message = 'hello';
//    $headers = "From:" . $_SESSION['user-email'] . "\r\n" .
//        "Reply-To:" . $_SESSION['user-email'] . "\r\n" .
//        'X-Mailer: PHP/' . phpversion();
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    ?>