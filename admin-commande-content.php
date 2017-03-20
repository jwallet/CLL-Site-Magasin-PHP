<?php if(isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT id FROM menu WHERE isnow=1;");
    $stmt->execute();
    $stmt->bind_result($idmenu);
    $stmt->fetch();
    $stmt->free_result();

    $itemsBdTitre = array();

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
}
?>
<div class="container">
    <div class="section">
        <form action="admin-commande-validation" method="POST">
            <input type="hidden" name="idmenu" value="<?php echo $idmenu; ?>">
            <input type="hidden" name="idpersonne" value="<?php echo $_GET['id']; ?>">
            <div class="row">
            <?php for($i=0; $i<sizeof($itemsBdId); $i++){
                $Quantite=0;
                $stmt= $mysqli->prepare("SELECT IFNULL(Quantite,0) FROM commande c JOIN commande_detail cd ON c.id = cd.idcommande JOIN item i ON cd.iditem = i.id WHERE c.idpersonne=? and c.idmenu=? and cd.iditem=?;");
                $stmt->bind_param("iii", $_GET['id'],$idmenu,$itemsBdId[$i]);
                $stmt->execute();
                $stmt->bind_result($Quantite);
                $stmt->fetch();
                $stmt->free_result();
                if (!isset($Quantite)){
                    $Quantite=0;
                }
                ?>
                    <div class="col s12">
                        <div class="input-field col s9">
                            <label class="black-text"><?php ECHO $itemsBdTitre[$i]; ?></label>
                        </div>
                        <div class="input-field col s3">
                            <input type="number" id="quantite<?php ECHO $itemsBdId[$i];?>" name="quantite<?php ECHO $itemsBdId[$i];?>" class="validate" min="0" max="20" value="<?php ECHO $Quantite;?>" required>
                        </div>
                    </div>
            <?php } ?>
            </div>
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a']?> " name="commandeEnrg" type='submit'>Enregistrer</button>
        </form>
    </div>
</div>