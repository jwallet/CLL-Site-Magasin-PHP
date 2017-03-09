<?php
$itemsId = array();
$itemsType = array();
$itemsTitre = array();
$itemsDesc = array();
$itemsImg = array();
$itemsPrix = array();
$stmt = $mysqli->prepare("SELECT item.id,titre,description,prix,image,type FROM item LEFT JOIN p_item ON item.idtype = p_item.id order by ordre;");
$stmt->execute();
$stmt->bind_result($id,$titre,$description,$prix,$image,$type);
while($stmt->fetch()) {
    $itemsId[] = $id;
    $itemsTitre[] = $titre;
    $itemsDesc[] = $description;
    $itemsPrix[] = $prix;
    $itemsImg[] = $image;
    $itemsType[] = $type;
}
?>
<?php if (isset($_SESSION['toast']) == 'plat-mod'){?>
<script type="text/javascript">
    $(document).ready(function () {
        Materialize.toast('Le plat a été mis à jour', 4000);
    });
</script>
<?php
} ?>
<div class="container col">
    <ul class="collection">
        <?php for($i=0; $i<sizeof($itemsId); $i++){?>
                <li class="collection-item avatar" style="padding-left:80px;">
                    <a style="color:black;" href="admin-plat?id=<?php echo $itemsId[$i]; ?>">
                        <span style="background-image:url('<?php if( $itemsImg[$i]!=null and  $itemsImg[$i]!=""){ echo "upload/".$itemsImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center;background-size:auto 60px;width:60px;height: 60px; margin-top:-8px;margin-left:-6px;" alt="" class="circle"></span>
                        <span class="title">
                            <?php echo ucfirst(strtolower($itemsTitre[$i])); ?>
                        </span>
                        <span class="<?php echo $_GLOBAL['couleur2a']; ?>-text" style="padding-left:8px;font-size:14px;font-style: italic;">
                            <?php echo ucfirst(strtolower($itemsType[$i])); ?>
                        </span><br/>
                        <span style="font-size:85%;">
                            <?php echo $itemsDesc[$i]; ?>
                        </span>
                        <a class="secondary-content <?php echo $_GLOBAL['couleur2a']; ?>-text" style="font-size:90%;"><br/><?php echo money_format('%(#10n', ($itemsPrix[$i])); ?></a>
                    </a>
                </li>
                <?php
            }?>
    </ul>
</div>