<?php $stmt = $mysqli->prepare("SELECT textarea FROM pages WHERE categorie LIKE 'entreprise' AND nom LIKE 'rejoindre';");
$stmt->execute();
$stmt->bind_result($tarea);
$stmt->fetch();
?>
<h5 style="padding-top:6px;">Nous rejoindre</h5>
<div class="divider" style="margin-bottom:6px;"></div>
<?php echo $tarea; ?>
<?php
$stmt->free_result();
$stmt->close();
?>

<!-- TEXTE PAR DEFAUT DE TINYMCE -->
<!-- <div class="row s12 left-align">-->
<!--    <div class="col s5">-->
<!--        <b>Contact</b><br/>-->
<!--    </div>-->
<!--    <div class="col s7">-->
<!--        Madame Carole Blanchette<br/>-->
<!--        Téléphone: (418) 831-2390<br/>-->
<!--        Email: <mail>laboiteabouf@outlook.com</mail>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="row s12 left-align">-->
<!--    <div class="col s5">-->
<!--        <b>Emplacement</b>-->
<!--    </div>-->
<!--    <div class="col s7">-->
<!--        248 rue des pervenches<br/>-->
<!--        Saint-Nicolas<br/>-->
<!--        Québec, G7A 3M3<br/>-->
<!--        Canada-->
<!--    </div>-->
<!--</div>-->
