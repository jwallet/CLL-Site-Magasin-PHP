<?php $stmt = $mysqli->prepare("SELECT textarea FROM pages WHERE categorie LIKE 'termesetconditions' AND nom LIKE 'termes';");
$stmt->execute();
$stmt->bind_result($tarea);
$stmt->fetch();
?>
<div class="container">
    <div class="section">
        <h5 style="padding-top:6px;">Termes et conditions du site</h5>
        <div class="divider" style="margin-bottom:6px;"></div>
        <?php echo $tarea; ?>
        <?php
        $stmt->free_result();
        $stmt->close();
        ?>
    </div>
</div>
