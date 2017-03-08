<?php
include("bd-connect.php");
include("meta.php");
require 'phpmailer/PHPMailerAutoload.php';

$prenom = $_SESSION['user-prenom'];
$nom = $_SESSION['user-nom'];
$email = $_SESSION['user-email'];
$telephone = $_SESSION['user-telephone'];
$adresse = $_SESSION['user-adresse'];

$idpersonne = $_SESSION['user-id'];

$sql = "SELECT id FROM menu WHERE isnow=1";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($un);
$stmt->fetch();
$idmenu = $un;
$stmt->free_result();
$stmt->close();

$sql ="SELECT c.id, i.id, c.date, m.titre, i.titre, i.description, i.prix, 
                  t.type, d.quantite, c.idpersonne, p.prenom, p.nom, p.email
            FROM commande c JOIN commande_detail d ON c.id = d.idcommande 
            JOIN personne p ON c.idpersonne = p.id
            JOIN menu m ON c.idmenu = m.id
            JOIN item i ON d.iditem = i.id
            JOIN p_item t ON i.idtype = t.id
            WHERE c.idpersonne=? AND c.idmenu=? ORDER BY t.ordre";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ii",  $idpersonne, $idmenu);
$stmt->execute();

$TABiditem = array();
$TABtitreitem = array();
$TABdescription = array();
$TABprix = array();
$TABtype = array();
$TABquantite = array();

$stmt->bind_result($idcommande,$iditem,$datecommande,$titremenu,$titreitem,$description,$prix,
    $type, $quantite, $idpersonne, $prenom, $nom, $email);

while($stmt->fetch()){
    $TABiditem[] = $iditem;
    $TABtitreitem[] = $titreitem;
    $TABdescription[] = $description;
    $TABprix[] = $prix;
    $TABtype[] = $type;
    $TABquantite[] = $quantite;
}
?>

<?php
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
$mail->addCC($_GLOBAL['mail-user'], 'Info');
$mail->addReplyTo($_GLOBAL['mail-user'], 'Info');
$mail->isHTML(true);
$mail->Subject = '[' . $titremenu . '] Confirmation de commande #' . $idcommande;
$mail->CharSet = 'UTF-8';
$dayend = $_GLOBAL['jour-limite-commander-text'];
$soustotal = 0;
$message = "<div class=\"container\">
    <div class=\"section\">
        <h5>Commande</h5>
        <div class=\"divider\"></div>
        <p>
            Numéro de commande : " . $idcommande . "<br/>
            Commande reçu le : " . strftime("%A, %e %B %Y",date(strtotime($datecommande))) . "<br/>
            Informations du menu :" . $titremenu . ' (no.' . $idmenu . ')' . "
        </p>
        <p>
            Numéro du client : " . $idpersonne . "<br/>
            Nom du client : " . $prenom . " " . $nom . "<br/>
            Courriel du client : <mail>" . $email . "</mail><br/>
            Téléphone du client : " . $telephone . "<br/>
            Adresse du client : " . $adresse . "<br/>
        </p>
        <h5>Détails de la commande</h5>
        <div class=\"divider\"></div>";

            for($i=0; $i<sizeof($TABiditem); $i++){
                $message.= "<p>" . ucfirst(strtolower($TABtype[$i])) . " : "
                    . ucfirst(strtolower($TABtitreitem[$i]))
                    . " (No." . $TABiditem[$i] . ")<br/>Prix : "
                    . money_format('%(#10n', ($TABprix[$i])) . " (chacun) x "
                    . $TABquantite[$i] . " portions = " . money_format('%(#10n', ($TABprix[$i]*$TABquantite[$i]))
                    . " </p>";
                $soustotal+= $TABprix[$i]*$TABquantite[$i];
            }
            $message.= "<p>Sous-total : " . money_format('%(#10n', ($soustotal))
                . "<br/>TVQ (9.975%) : " . money_format('%(#10n', ($soustotal*0.09975))
                . "<br/>TPS (5%) : " . money_format('%(#10n', ($soustotal*0.05))
                . "<br/>Prix total : " . money_format('%(#10n', ($soustotal*1.14975))
                . " *</p><p class='grey-text text-darken-1'>* Le prix total vous sera chargé 
                sur place lors de votre visite à la Boîte à Bouf. Voir la zone ci-dessous 
                pour connaitre nos heures de cueillete et notre emplacement.</p></div></div>";

$mail->Body    = $message;
if(!$mail->send()){
    echo "failed";
}else{
    echo "successed";
}
?>
