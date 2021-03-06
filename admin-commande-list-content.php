<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'mod-commande') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('La commande du client a été mise à jour', 3000);
            });
        </script>
        <?php
    } elseif ($_SESSION['toast'] == 'erreur-commande') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Une erreur s est produite, veuillez reessayer plus tard', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}?>
<?php
$personnesId = array();
$personnesPrenom = array();
$personnesNom = array();
$personnesTelephone = array();
$personnesAdresse = array();
$personnesEmail = array();

//trouve les plats de la semaine selon l'ordre des categories
$itemsBdId = array();
$itemsBdType = array();
$itemsBdTitre = array();
$itemsBdDesc = array();
$itemsBdImg = array();
$itemsBdPrix = array();
$itemsBdOrdre = array();

$stmt = $mysqli->prepare("SELECT i.id, pi.type, i.titre, i.description, i.image, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre;");
$stmt->execute();
$stmt->bind_result($un,$deux,$trois, $quatre, $cinq, $six);
$j = 0;
while($stmt->fetch()) {
    $itemsBdId[] = (string)$un;
    $itemsBdType[] = $deux;
    $itemsBdTitre[] = $trois;
    $itemsBdDesc[] = $quatre;
    $itemsBdImg[] = $cinq;
    $itemsBdPrix[] = $six;
}
$stmt->free_result();
//Aller chercher tous les clients actifs
$stmt = $mysqli->prepare("SELECT DISTINCT(p.id),p.prenom,p.nom FROM personne AS p LEFT JOIN commande AS c ON c.idpersonne = p.id LEFT JOIN commande_detail AS cd ON c.id = cd.idcommande WHERE p.isadmin=0 and p.isnew!=2 order by cd.quantite DESC, p.nom;");
$stmt->execute();
$stmt->bind_result($id,$prenom,$nom);
while($stmt->fetch()) {
    $personnesId[] = $id;
    $personnesPrenom[] = $prenom;
    $personnesNom[] = $nom;
}
$stmt->free_result();
?>
<table class="container centered highlight bordered responsive-table">
    <thead>
    <tr>
        <th data-field="Client"><br/><br/></th>
        <?php for($i=0; $i<sizeof($itemsBdId); $i++){?>
            <th data-field="itemid" style="cursor:pointer;text-align: right;margin:0;padding:0;">
                <div class="tooltipped" data-position="left" data-delay="50" data-tooltip="<?php echo ucfirst(strtolower($itemsBdTitre[$i])); ?>" style="background-image:url('<?php if( $itemsBdImg[$i]!=null and  $itemsBdImg[$i]!=""){ echo "upload/".$itemsBdImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center; background-repeat:no-repeat;border:2px solid white;background-size:100px auto;border-radius:10px;width:100px;height:50px;margin-top:-20px;" alt="<?php echo ucfirst(strtolower($itemsBdTitre[$i])); ?>" >
                </div>
            </th>
        <?php } ?>
            <th data-field="total" style="text-align: right;">Total ($)</th>
    </tr>
    </thead>

    <tbody>
<!--        <tr>-->
<!--            <td><b>Total<br/>(portions)</b></td>-->
<!--            --><?php //for($j=0; $j<sizeof($itemsBdId); $j++){
//                $TotalQuantite = 0;
//                $stmt = $mysqli->prepare("SELECT SUM(Quantite) FROM commande_detail AS cd JOIN commande AS c ON c.id = cd.idcommande JOIN personne p ON p.id = c.idpersonne JOIN menu m on m.id = c.idmenu WHERE cd.iditem = ? and m.isnow=1 and p.isnew!=2;");
//                $stmt->bind_param("i",$itemsBdId[$j]);
//                $stmt->execute();
//                $stmt->bind_result($TotalQuantite);
//                $stmt->fetch();
//                $stmt->free_result();
//                if (!isset($TotalQuantite)){
//                    $TotalQuantite = 0;
//                }
//                ?>
<!--                <td>--><?php //echo $TotalQuantite ;?><!-- </td>-->
<!--                --><?php
//            }
//            ?>
<!--            --><?php
//            $stmt = $mysqli->prepare("SELECT SUM(Quantite*i.prix) FROM commande_detail AS cd JOIN commande AS c ON c.id = cd.idcommande JOIN personne p on p.id = c.idpersonne JOIN menu m on m.id = c.idmenu JOIN item i ON cd.iditem = i.id WHERE m.isnow=1 and p.isnew!=2;");
//            $stmt->execute();
//            $stmt->bind_result($Total);
//            $stmt->fetch();
//            $stmt->free_result();
//            if (!isset($Total)){
//                $Total = 0;
//            }
//            ?>
<!--            <td>--><?php //echo money_format('%(#10n', ($Total));?><!--</td>-->
<!--        </tr>-->
    <?php
    for($i=0; $i<sizeof($personnesId); $i++)
    {
        $TotalPers = 0;
        $idcommande = 0;
        $stmt = $mysqli->prepare("SELECT c.id FROM commande AS c JOIN menu m ON m.id = c.idmenu WHERE c.idpersonne = ? and m.isnow=1;");
        $stmt->bind_param("i",$personnesId[$i]);
        $stmt->execute();
        $stmt->bind_result($idcommande);
        $stmt->fetch();
        $stmt->free_result();
        ?>
        <tr>
            <td> <a style="color:black;" href="admin-commande?id=<?php echo $personnesId[$i]; ?>"><b><?php echo ucfirst(strtolower($personnesPrenom[$i])) . "<br/>" . ucfirst(strtolower($personnesNom[$i])) ;?></b></td>
            <?php for($j=0; $j<sizeof($itemsBdId); $j++){
                $Quantite = 0;
                $stmt = $mysqli->prepare("SELECT Quantite FROM commande_detail AS cd JOIN commande AS c ON c.id = cd.idcommande WHERE cd.iditem = ? AND c.id=?;");
                $stmt->bind_param("ii",$itemsBdId[$j],$idcommande);
                $stmt->execute();
                $stmt->bind_result($Quantite);
                $stmt->fetch();
                $stmt->free_result();
                ?>
                <td><?php if($Quantite!=0){echo "<b>$Quantite</b>";}else{ echo "<span class='grey-text'>$Quantite</span>";} ;?></td>
            <?php
            }
            $stmt = $mysqli->prepare("SELECT SUM(i.prix * cd.Quantite) FROM item AS i JOIN commande_detail AS cd ON i.id = cd.iditem JOIN commande c ON c.id = cd.idcommande JOIN personne p ON p.id = c.idpersonne WHERE c.id = ? and p.isnew!=2;");
            $stmt->bind_param("i",$idcommande);
            $stmt->execute();
            $stmt->bind_result($TotalPers);
            $stmt->fetch();
            $stmt->free_result();
            if (!isset($TotalPers)){
                $TotalPers = 0;
            }
            ?>
                <td><?php echo money_format('%(#10n', ($TotalPers));?></td>
        </tr>
    <?php
    }
    ?>

    </tbody>

</table>
