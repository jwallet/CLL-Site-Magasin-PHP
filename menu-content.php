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
                    <div class="collapsible-header active <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>">
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
                            <div class="menu-back-img" style="background-image:url('https://i.ytimg.com/vi/jyaLMHBKCic/maxresdefault.jpg');">
                                <div class="menu-back-img-shadow">
                                    <div class="container">
                                        <div class='section'>
    <!--                                DEBUT container de l'item-->
                                            <div class="menu-container">
                                                <div class="section">
                                                    <div class="white-text row s12" style="margin:0px 20px 0px 20px;">

                                                        <h5 class="col s6"><?php echo $itemsBdTitre[$j]; ?></h5>
                                                        <input type="hidden" id="hiddenprix<?php echo $j; ?>" value="<?php echo $itemsBdPrix[$j]; ?>"/>
                                                        <h5 class="col s6 right-align"><?php echo $itemsBdPrix[$j]; ?>$</h5>

                                                        <div class="col s12">
                                                            <img class="right hide-on-small-only" style="padding-left:20px;" src="css/ico/logo_blanc.png" width="auto" height="160px"/>
                                                            <h6>description a a a
                                                                description  a a a  description  a aaa adescriptio naaa
                                                                description  a a a adescription  aa description  aa a descriptiona a a
                                                                description  a  a a a a adescription  a aa description descriptiona a  a
                                                                description  a aa description  a aa description aaa  descriptiona a
                                                                description  a a a  description  a aaa adescriptio naaa
                                                                description  a a a adescription  aa description  aa a descriptiona a a
                                                                description  a  a a a a adescription  a aa description descriptiona a  a
                                                            </h6>

                                                        </div>
                                                        <div class="col s12">
                                                            <div class="row s12">
    <!--                                                            --><?php //if(!isset($_SESSION['user-online'])){ echo "hide"; } ?>
                                                                <div class="col s12">
                                                                    <form action="#">
                                                                        <div>
                                                                             <p class="range-field">
                                                                                 <input type="range" id="slider" value=1 min="1" step="1" max="100" oninput="fncslider(this.value,<?php echo $j; ?>)"/>
                                                                                 <label for="slider">Quantite: </label>
                                                                                 <span name="quantite" id="slidervalue<?php echo $j; ?>">1</span>
                                                                                 <label for="slider">Prix: </label>
                                                                                 <span name="prix" id="sliderprix<?php echo $j; ?>"><?php echo $itemsBdPrix[$j]; ?>$</span>
                                                                            </p>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                                <div class="<?php if(isset($_SESSION['user-online'])){ echo "hide"; } ?>">
                                                                    <div class="col s12">
                                                                        <button style="width: 100%" class="btn-large waves-effect waves-light col <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">
                                                                                Ajouter au panier
                                                                            </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    <!--                                FIN container de l'item-->
    <?php
        echo "                        </div>
                                    </div>
                                </div>
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
<style>

  input[type=range]::-webkit-slider-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>;
  }
  input[type=range]::-moz-range-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>
  }
  input[type=range]::-ms-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>;
  }

  /***** These are to edit the thumb and the text inside the thumb *****/
  input[type=range] + .thumb {
      background-color: whitesmoke;
  }
  input[type=range] + .thumb.active .value {
      color: <?php echo $_GLOBAL['couleur1a']; ?>;
  }
</style>

                                            <script type="text/javascript">
                                                function fncslider(valeur,y){
                                                    var prix = document.getElementById("hiddenprix"+y).value;
                                                    document.getElementById("sliderprix"+y).innerHTML = (valeur * prix).toFixed(2) + "$";
                                                    document.getElementById("slidervalue"+y).innerHTML = valeur;
                                                    }
                                            </script>
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
