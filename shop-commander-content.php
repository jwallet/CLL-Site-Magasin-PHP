<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'order-added') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Commande envoyée.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
if (isset($_SESSION['user-online'])){
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
            WHERE c.idpersonne=? AND c.idmenu=?";
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
    $confirmation = ($idcommande!=null);
}
else{
    $confirmation=false;
}
?>
<div class="container">
    <div class="section">
        <?php if($confirmation){?>
        <h5>Confirmation de la commande</h5>
        <div class="divider"></div>
            <p>Nous avons bien reçu votre commande.
                Notez qu'il est possible de modifier votre commande tout au long
                de la semaine jusqu'au <?php $dayend = $_GLOBAL['jour-limite-commander-text'];
                echo strftime("%A, %e %B %Y",date(strtotime("next $dayend"))); ?>
            </p>
            <p>Nous avons envoyé une copie de cette confirmation à votre courriel
                <?php echo "<mail>" . $email . "</mail>"; ?>
            </p>
            <h5>Commande</h5>
            <div class="divider"></div>
            <p>
                Numéro de commande : <?php echo $idcommande; ?><br/>
                Commande reçu le : <?php echo strftime("%A, %e %B %Y",date(strtotime($datecommande))); ?><br/>
                Informations du menu : <?php echo $titremenu . ' (no.' . $idmenu . ')'; ?>
            </p>
            <p>
                Numéro du client : <?php echo $idpersonne; ?><br/>
                Nom du client : <?php echo $nom . ", " . $prenom; ?><br/>
                Courriel du client : <?php echo "<mail>" . $email . "</mail>"; ?>
            </p>
            <h5>Détails de la commande</h5>
        <div class="divider"></div>

            <?php
            $soustotal = 0;
            for($i=0; $i<sizeof($TABiditem); $i++){
                echo "<p>(No." . $TABiditem[$i] . ") "
                    . ucfirst(strtolower($TABtitreitem[$i])) . " : "
                    . ucfirst(strtolower($TABtype[$i])) . "<br/>Prix : "
                    . money_format('%(#10n', ($TABprix[$i])) . " (chacun) x "
                    . $TABquantite[$i] . " portions = " . money_format('%(#10n', ($TABprix[$i]*$TABquantite[$i]))
                    . " </p>";
                $soustotal+= $TABprix[$i]*$TABquantite[$i];
            }
            echo "<p>Sous-total : " . money_format('%(#10n', ($soustotal))
                . "<br/>TVQ (9.975%) : " . money_format('%(#10n', ($soustotal*0.09975))
                . "<br/>TPS (5%) : " . money_format('%(#10n', ($soustotal*0.05))
                . "<br/>Prix total : " . money_format('%(#10n', ($soustotal*1.14975))
                . " *</p><p class='grey-text text-darken-1'>* Le prix total vous sera chargé 
                sur place lors de votre visite à la Boîte à Bouf. Voir la zone ci-dessous 
                pour connaitre nos heures de cueillete et notre emplacement.</p>";
            include_once('home-horaire-content.php');
            include_once('home-contact-content.php');
            ?>

        <?php }
        else {
            ?>
            <h5>Confirmation de votre commande</h5>
            <div class="divider"></div>
            <p>Nous avons reçu aucune commande votre part pour le menu de cette semaine.
                Si ceci est un erreur, veuillez contacter avec nous par la zone
                <a href="home-a-propos">Entreprise</a> en bas de page.
            </p>
        <?php
        }?>
    </div>
</div>
