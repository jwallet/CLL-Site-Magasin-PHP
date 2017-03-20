<?php $stmt = $mysqli->prepare("SELECT textarea FROM pages WHERE categorie LIKE 'entreprise' AND nom LIKE 'horaire';");
$stmt->execute();
$stmt->bind_result($tarea);
$stmt->fetch();
?>
    <h5 style="padding-top:6px;">Nos horaires</h5>
<div class="divider" style="margin-bottom:6px;"></div>
<?php echo $tarea; ?>
<?php
$stmt->free_result();
$stmt->close();
?>

<!--TEXTE PAR DEFAUT DE TINYMCE-->
<!--<div class="row s12 left-align">-->
<!--    <div class="col s5">-->
<!--        <b>Commande en ligne</b><br/>-->
<!--    </div>-->
<!--    <div class="col s7">-->
<!--        Du lundi au vendredi<br/>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="row s12 left-align">-->
<!--    <div class="col s5">-->
<!--        <b>Horaire ouverture</b>-->
<!--        <br/>Boîte à Bouf<br/>(Cueillette)-->
<!--    </div>-->
<!--    <div class="col s7">-->
<!--        Lundi, de 12h à 19h<br/>-->
<!--        Mardi, de 8h à 19h-->
<!--    </div>-->
<!--</div>-->
