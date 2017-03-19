<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'item-added') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Plat ajouté.', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
elseif(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'order-failed') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('L\'envoie de la commande a échoué.', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
if(date("N")>$_GLOBAL['jour-limite-commander']){
    setcookie("shoppingcart", null, time() -10);//too bad, too late
}
if(isset($_COOKIE["shoppingcart"])) {
    $itemsId = array();
    $itemsQuant = array();
    $itemsType = array();
    $itemsTitre = array();
    $itemsDesc = array();
    $itemsImg = array();
    $itemsPrix = array();

    $sql = "SELECT id FROM menu WHERE isnow=1";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($un);
    $stmt->fetch();
    $idmenu = $un;
    $stmt->free_result();

    $cookie = explode(">",$_COOKIE["shoppingcart"]);
    $idmenucookie = (integer)$cookie[0];

    if($idmenucookie!=$idmenu){
        setcookie("shoppingcart",null,time()-1);//expired
        $empty=true;
    }
    else{
        $entries = explode("|",$cookie[1]);

        foreach ($entries as $item){
            list($id,$quant) = explode(":", $item);
            if((isset($_POST['updateid']) and isset($_POST['updatequant']))){
                //check if user updated quantity
                if((integer)$_POST['updateid']==$id) {
                    $quant = $_POST['updatequant'];
                    $eId[] = $id;
                    $eQuant[] = $quant;
                }
                else {
                    $eId[] = $id;
                    $eQuant[] = $quant;
                }
            }
            elseif(isset($_GET['d'])){
                //check if user deleted an item, if so, skip it
                if((integer)$_GET['d']!=$id) {
                    $eId[] = $id;
                    $eQuant[] = $quant;
                }
            }
            //otherwise keep going
            else{
                $eId[] = $id;
                $eQuant[] = $quant;
            }
        }
        if((isset($_POST['updateid']) and isset($_POST['updatequant'])) OR isset($_GET['d'])){
            $restorecookie = "";
            if(isset($eId) and isset($eQuant)){
                $restorecookie = $idmenucookie . '>' . $eId[0] . ':' . $eQuant[0];
                for($k = 1; $k < sizeof($eId); $k++){
                    $restorecookie = $restorecookie . '|' . $eId[$k] . ':' . $eQuant[$k];
                }
            }
            if($restorecookie!="") {
                setcookie("shoppingcart", $restorecookie, time() + 604800);//expire in a week
            }
            else{
                setcookie("shoppingcart", null, time() -1);//nothing to show, so expired
            }
        }
        if(isset($eId) and isset($eQuant)) {
            $j = 0;
            foreach ($eId as $id) {
                $sql = "SELECT pi.type, i.titre, i.image, i.prix FROM item i JOIN p_item pi ON i.idtype = pi.id WHERE i.id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($un, $deux, $trois, $quatre);
                $stmt->fetch();
                $itemsType[] = $un;
                $itemsTitre[] = $deux;
                $itemsImg[] = $trois;
                $itemsPrix[] = $quatre;
                $itemsId[] = $id;
                $itemsQuant[] = $eQuant[$j];
                $j++;
                $stmt->free_result();
            }
            $empty = false;
        }
        else{
            $empty = true;
        }
    }
}
else{
    $empty=true;
}
?>
<div class="container col">
    <ul class="collection">
        <?php if(!$empty) {
            $total=0;
            $sql ="SELECT textarea FROM pages WHERE nom LIKE 'commander' AND categorie LIKE 'confirmation'";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($tarea);
            $stmt->fetch();
            $stmt->close();
            for($i=0; $i<sizeof($itemsId); $i++){?>
                <li class="collection-item avatar" style="padding-top:15px;padding-bottom:15px;padding-left:100px;">
                    <div class="circle" style="background-image:url('<?php if( $itemsImg[$i]!=null and  $itemsImg[$i]!=""){ echo "upload/".$itemsImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center; background-repeat:no-repeat;border:2px solid white;background-size:auto 100px;border-radius:20px;width:80px;height:84px;margin-top:-6px;" alt="<?php echo ucfirst(strtolower($itemsBdTitre[$i])); ?>" >
                    </div>
                    <span class="title"><?php echo ucfirst(strtolower($itemsTitre[$i])); ?></span>
                    <br/><span class="<?php echo $_GLOBAL['couleur2a']; ?>-text" style="font-size:14px;font-style: italic;"><?php echo ucfirst(strtolower($itemsType[$i])); ?></span>
                    <p><form action="shop-cart" method="post" style="padding:0;margin:0;">
                        <input name="updateid" type="hidden" value="<?php echo $itemsId[$i]; ?>"/>
                        <input name="updatequant" style="width: 50px;float:left;height: 1.5rem;border:1px solid #AAA;" type="number" value="<?php echo $itemsQuant[$i]; ?>"/>
                        <button type="submit" style="border:none;background:none;padding:0;margin:0;width: 30px; margin-right:20px;" class="<?php echo $_GLOBAL['couleur1a']; ?>-text">
                            <i class="material-icons">update</i>
                        </button>
                        <a href="shop-cart?d=<?php echo $itemsId[$i]; ?>" class="<?php echo $_GLOBAL['couleur1a']; ?>-text">
                            <i class="material-icons">delete</i>
                        </a>
                    </form></p>
                    <a class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text" style="margin-top:0px;font-size:120%;"><?php echo money_format('%(#10n', ($itemsPrix[$i]*$itemsQuant[$i])); ?></a>
                    <a class="secondary-content <?php echo $_GLOBAL['couleur2a']; ?>-text" style="margin-top:10px;font-size:90%;"><br/><?php echo money_format('%(#10n', ($itemsPrix[$i])); ?> /chacun</a>
                </li>
            <?php
            $total += $itemsQuant[$i]*$itemsPrix[$i];
            }?>
            <!-- Modal Structure -->
            <div id="modalCommander" class="modal">
                <div class="modal-content">
                    <h4>Commander</h4>
                    <?php echo $tarea;?>
                    <b>Désirez-vous poursuivre et commander ces plats?</b>

                </div>
                <div class="modal-footer">
                    <a href="shop-commander-validation" class="btn modal-action modal-close waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>">Oui</a>
                    <a class="modal-action modal-close waves-effect waves-light btn-flat"><b>Non, annuler</b></a>
                </div>
            </div>

            <li class="collection-item">
                <span>Sous-total</span><a class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text" style="font-size:120%;"><?php echo money_format('%(#10n', ($total)); ?></a><br/>
                <div class="divider" style="margin-top:8px;margin-bottom:8px;"></div>
                <span>TVQ (9.975%)</span><a class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text" style="font-size:120%;"><?php echo money_format('%(#10n', ($total*0.09975)); ?></a><br/>
                <span>TPS (5%)</span><a class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text" style="font-size:120%;"><?php echo money_format('%(#10n', ($total*0.05)); ?></a>
                <div class="divider" style="margin-top:8px;margin-bottom:8px;"></div>
                <span>Total</span><a class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text" style="font-size:120%;"><?php echo money_format('%(#10n', ($total*1.14975)); ?></a><br/>
                <a href="#modalCommander" class="btn waves-effect waves-light secondary-content <?php if(date("N")>$_GLOBAL['jour-limite-commander']){ echo "disabled";}?> <?php echo $_GLOBAL['couleur1a']; ?>" style="margin-top:20px;margin-bottom:20px;">Commander</a>
            </li>
        <?php }
        else{
            echo "<h5 class='center'>Panier vide</h5><p class='center'>Ajouter des plats à partir du <a href='menu'>menu de la semaine</a> pour passer une commande.</p>";
        }?>
    </ul>
</div>
<script type="text/javascript">
    $('.modal').modal();
</script>