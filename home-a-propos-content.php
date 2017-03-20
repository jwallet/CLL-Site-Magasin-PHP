<?php $stmt = $mysqli->prepare("SELECT textarea FROM pages WHERE categorie LIKE 'entreprise' AND nom LIKE 'apropos';");
$stmt->execute();
$stmt->bind_result($tarea);
$stmt->fetch();
?>
<div class="container">
    <div class="section">
        <table>
            <thead>
            <tr>
                <th style="font-size:120%;">À propos de la <?php echo $_GLOBAL['entreprise'];?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $tarea; ?>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
        $stmt->free_result();
        $stmt->close();
        ?>
<?php include_once('home-horaire-content.php');
    include_once('home-contact-content.php');
    ?>
    </div>
</div>
<?php include_once('home-contact-map-content.php');?>
