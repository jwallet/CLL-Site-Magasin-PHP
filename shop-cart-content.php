<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'order-added') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Commande ajoutée.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
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
            for($i=0; $i<sizeof($itemsId); $i++){?>
                <li class="collection-item avatar" style="padding-left:80px;">
                    <span style="background-image:url('<?php if( $itemsImg[$i]!=null and  $itemsImg[$i]!=""){ echo "upload/".$itemsImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center;background-size:auto 60px;width:60px;height: 60px; margin-top:-8px;margin-left:-6px;" alt="" class="circle"></span>
                    <span class="title"><?php echo ucfirst(strtolower($itemsTitre[$i])); ?></span><span style="padding-left:8px;color:#aaa;font-size:14px;font-style: italic;"><?php echo ucfirst(strtolower($itemsType[$i])); ?></span>
                    <p><form action="shop-cart" method="post" style="padding:0;margin:0;">
                        <input name="updateid" type="hidden" value="<?php echo $itemsId[$i]; ?>"/>
                        <input name="updatequant" style="width: 50px;float:left;height: 1.5rem;border:1px solid #AAA;" type="number" value="<?php echo $itemsQuant[$i]; ?>"/>
                        <button type="submit" style="border:none;background:none;padding:0;margin:0;width: 30px;" class="<?php echo $_GLOBAL['couleur1a']; ?>-text">
                            <i class="material-icons">update</i>
                        </button>
                    </form></p>
                    <a class="secondary-content"><?php echo $itemsPrix[$i]."$"; ?></a>
                    <a href="shop-cart?d=<?php echo $itemsId[$i]; ?>" class="secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text"><br/><i class="material-icons">delete</i></a>
                </li>
            <?php }?>
        <?php }
        else{
            echo "<h5 class='center'>Panier vide</h5><p class='center'>Ajouter des plats à partir du <a href='menu'>menu de la semaine</a> pour passer une commande.</p>";
        }?>
</ul>
</div>