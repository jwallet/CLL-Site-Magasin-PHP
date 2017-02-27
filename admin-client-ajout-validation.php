<?php
include("bd-connect.php");
require 'phpmailer/PHPMailerAutoload.php';
if(isset($_POST['email'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
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
    $mail->addAddress('guillaumeprudhomme12@gmail.com');
    $mail->addReplyTo($_GLOBAL['mail-user'], 'Info');
    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }


    $password = md5($email);
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
        $sql = "INSERT INTO personne (prenom,nom,telephone,email,passe) values (?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssss", $prenom, $nom, $telephone, $email, $password);
        $stmt->execute();
        $_SESSION['toast'] = "client-ajout";
        $redirect = "admin";
    }
    $stmt->close();
}
?>
<html>
<head>
<!--    <meta http-equiv="refresh" content="0;URL='--><?php //echo $redirect; ?><!--'"/>-->
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