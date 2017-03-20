<?php
$itemsBdQte = array();
$itemsBdTitre = array();
$itemsBdPrix = array();
$stmt = $mysqli->prepare("SELECT SUM(quantite),i.titre, i.prix FROM commande_detail cd JOIN item i ON cd.iditem = i.id GROUP BY i.titre,i.prix order by SUM(quantite) DESC LIMIT 3");
$stmt->execute();
$stmt->bind_result($un,$deux,$trois);
$j = 0;
while($stmt->fetch()) {
    $itemsBdQte[] = $un;
    $itemsBdTitre[] = $deux;
    $itemsBdPrix[] = $trois;
}
$stmt->free_result();
$stmt = $mysqli->prepare("SELECT quantite,i.titre, i.prix FROM commande_detail cd JOIN item i ON cd.iditem = i.id JOIN commande c ON cd.idcommande = c.id JOIN menu m ON c.idmenu = m.id WHERE m.isnow=1 order by quantite DESC LIMIT 4");
$stmt->execute();
$stmt->bind_result($un,$deux,$trois);
$j = 0;
while($stmt->fetch()) {
    $itemsBdQteWeek[] = $un;
    $itemsBdTitreWeek[] = $deux;
    $itemsBdPrixWeek[] = $trois;
}
$stmt->free_result();
?>
<h4 class="center"><b><u>Les trois repas les plus vendus</u></b></h4>
<table class="striped centered">
    <thead>
    <th data-field="TitreItem">Titre du repas</th>
    <th data-field="PrixItem">Prix du repas</th>
    <th data-field="Qteitem">Quantité Totale Vendue</th>
    </thead>
    <tbody>
    <?php for($j=0; $j<sizeof($itemsBdTitre); $j++){ ?>
        <tr>
            <td><?php echo $itemsBdTitre[$j];?></td>
            <td><?php echo money_format('%(#10n', $itemsBdPrix[$j]);?></td>
            <td><?php echo $itemsBdQte[$j];?></td>
        </tr>
    <?php }?>
    </tbody>
</table>
<br>
<h4 class="center"><b><u>Les ventes de la semaine</u></b></h4>
<table class="striped centered">
    <thead>
    <th data-field="TitreItem">Titre du repas</th>
    <th data-field="PrixItem">Prix du repas</th>
    <th data-field="Qteitem">Quantité Totale Vendue</th>
    </thead>
    <tbody>
    <?php for($j=0; $j<sizeof($itemsBdTitreWeek); $j++){ ?>
        <tr>
            <td><?php echo $itemsBdTitreWeek[$j];?></td>
            <td><?php echo money_format('%(#10n', $itemsBdPrixWeek[$j]);?></td>
            <td><?php echo $itemsBdQteWeek[$j];?></td>
        </tr>
    <?php }?>
    </tbody>
</table>