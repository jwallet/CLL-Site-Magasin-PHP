<?php
//trouve les plats de la semaine selon l'ordre des categories
$itemsBdId = array();
$itemsBdType = array();
$itemsBdTitre = array();
$itemsBdPrix = array();
$sql="SELECT i.id, pi.type, i.titre, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre;";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($un,$deux,$trois, $quatre);
$j = 0;
while($stmt->fetch()) {
    $itemsBdId[] = (string)$un;
    $itemsBdType[] = $deux;
    $itemsBdTitre[] = $trois;
    $itemsBdPrix[] = $quatre;
}
$stmt->free_result();
$j = 0;
$htmltype = null;
echo "
<ul class=\"collapsible\" data-collapsible=\"accordion\">";
    for($j=0;$j<sizeof($itemsBdId);$j++) {
        echo "
                <li>";
                if(strcmp($htmltype,$itemsBdType[$j])!= 0){
                ?>
                <div class="menu-header <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>" style='pointer-events:none;'>
                        <div class="container"><h5><u>
                            <?php echo ucfirst(strtolower($itemsBdType[$j])); ?>
                                </u></h5>
                        </div>
                    </div>
                <?php } ?>
                    <div class="collapsible-header <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>">
                        <div class="container">
                            <span class="<?php echo $_GLOBAL['couleur-menu-2a']. "-text text-" . $_GLOBAL['couleur-menu-2b'] ?>">
                                <b><?php echo ucfirst(strtolower($itemsBdTitre[$j])); ?></b>
                            </span>
                            <span class='secondary-content <?php echo $_GLOBAL['couleur-menu-3a']. "-text text-" . $_GLOBAL['couleur-menu-3b'] ?>'>
                                <b><?php echo $itemsBdPrix[$j]. "$" ?></b>
                            </span>
                        </div>
                    </div>
                    
                    <div class='collapsible-body' style='padding:0;'>
                        <span>
                            <div class="container">
                                <div class='section'>
                                //DEBUT container de l'item

        <div class="container row <?php if(!isset($_SESSION['user-online'])){ echo "hide"; } ?>">
            <form action="#" class="col l11 offset-l1 m11 offset-m1 s12">
                <div class="col s7">
                    <div class="col s3">
                        <a class="btn-floating btn waves-effect waves-light grey">
                            <i class="material-icons">remove</i>
                        </a>
                    </div>
                    <div class="col offset-s1 s2 pull-s1">
                        <h3 style="margin:0; padding-left:10px;">2</h3>
                    </div>
                    <div class="col s3">
                        <a class="btn-floating btn waves-effect waves-light grey">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                </div>
                <div class="col s5">
                    <button class="btn-large waves-effect waves-light col <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">Ajouter
                        <i class="material-icons left">add_shopping_cart</i>
                    </button>
                </div>
            </form>
        </div>
        <div class="container row <?php if(isset($_SESSION['user-online'])){ echo "hide"; } ?>">
            <div class="s12">
                <a style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b']?>" href='connect'>
                    Commander
                </a>
            </div>
        </div>
        </div>
<?php
                                //FIN container de l'item
        echo "                </div>
                            </div>
                        </span>
                    </div>
                </li>
        ";
        $htmltype = $itemsBdType[$j];
    }
echo "
</ul>";
?>

<!--echo"-->
<!--<div class=\"product-card\">-->
<!--    <div class=\"product-image\">-->
<!--        <a href='menu-item'>-->
<!--            <img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class=\"product-info\">-->
<!--        <h5>Manteau</h5>-->
<!--        <h6>$99.99</h6>-->
<!--    </div>-->
<!--</div>-->
