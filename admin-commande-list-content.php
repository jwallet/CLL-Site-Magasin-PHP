<?php
$personnesId = array();
$personnesPrenom = array();
$personnesNom = array();
$personnesTelephone = array();
$personnesAdresse = array();
$personnesEmail = array();

$CommandesId = array();
$CommandesQte = array();

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
$stmt = $mysqli->prepare("SELECT id,email,prenom,nom,telephone,adresse FROM personne WHERE isadmin=0 order by nom;");
$stmt->execute();
$stmt->bind_result($id,$email,$prenom,$nom,$telephone,$adresse);
while($stmt->fetch()) {
    $personnesId[] = $id;
    $personnesPrenom[] = $prenom;
    $personnesNom[] = $nom;
    $personnesTelephone[] = $telephone;
    $personnesAdresse[] = $adresse;
    $personnesEmail[] = $email;
}
$stmt->free_result();
$stmt->close();
?>

<table class="responsive-table">
    <thead>
    <tr>
        <th data-field="blabla"></th>
        <?php for($i=0; $i<sizeof($itemsBdId); $i++){?>
            <th data-field="id"><?php echo $itemsBdTitre[$i];?></th>
        <?php } ?>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td>Alvin</td>
        <td>Eclair</td>
        <td>$0.87</td>
    </tr>
    <tr>
        <td>Alan</td>
        <td>Jellybean</td>
        <td>$3.76</td>
    </tr>
    <tr>
        <td>Jonathan</td>
        <td>Lollipop</td>
        <td>$7.00</td>
    </tr>
    </tbody>
</table>
