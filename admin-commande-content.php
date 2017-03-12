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
        <form action="admin-plat-validation" method="POST">
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
                <div class="row">
                    <div class="col s6">
                        <span><b><?php ECHO $itemsBdTitre[$i]; ?></b></span>
                    </div>
                    <div class="col s6">
                        <div class="input-field">
                            <input type="number" id="quantite<?php ECHO $itemsBdId[$i];?>" name="quantite<?php ECHO $itemsBdId[$i];?>" class="validate" min="0" max="20" value="<?php ECHO $Quantite;?>" required>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a']?> "
                    type='submit'>Enregistrer</button>
        </form>
    </div>
</div>

<!--<div class="container" style="font-family: 'Roboto', sans-serif;font-weight: normal;">-->
    <!--    <div class="section">-->
    <!--        <h5 class="col s12">ALO</h5>-->
    <!--        <p class="col s12" style="min-height: 100px;">allo-->
    <!--        <div class="row s12" style="margin:-5%;padding:0%;">-->
    <!--            <form action="menu-validation" method="post">-->
    <!--                <div class="col s12" style="padding-left:0;padding-right: 0;">-->
    <!--                    <div class="input-group col center" style="padding-left:0;padding-right: 0;">-->
    <!--                          <span class="input-group-btn">-->
    <!--                          <button type="button" class="col btn btn-default btn-number--><?php //echo $j; ?><!-- --><?php //echo $_GLOBAL['couleur1a']; ?><!--" disabled="disabled" data-type="minus" data-field="quant--><?php //echo $j; ?><!--">-->
    <!--                              <span><i class="material-icons">remove</i></span>-->
    <!--                          </button>-->
    <!--                          </span>-->
    <!--                        <input type="text" style="width: 50px;margin:0;margin-top:-28px;padding:0;height: 2.2rem;border:2px solid #CCC;" name="quant--><?php //echo $j; ?><!--" class="form-control input-number--><?php //echo $j; ?><!-- center" value="1" min="1" max="100">-->
    <!--                        <span class="input-group-btn">-->
    <!--                          <button type="button" class="col btn btn-default btn-number--><?php //echo $j; ?><!-- --><?php //echo $_GLOBAL['couleur1a']; ?><!--" data-type="plus" data-field="quant--><?php //echo $j; ?><!--">-->
    <!--                              <span><i class="material-icons">add</i></span>-->
    <!--                          </button>-->
    <!--                        </span>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>