<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'plat-mod') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le plat a été mis à jour', 3000);
            });
        </script>
        <?php
    } elseif ($_SESSION['toast'] == 'plat-del') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le plat a été effacé', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}

$itemsId = array();
$itemsType = array();
$itemsTitre = array();
$itemsDesc = array();
$itemsImg = array();
$itemsPrix = array();
$stmt = $mysqli->prepare("SELECT item.id,titre,description,prix,image,type FROM item LEFT JOIN p_item ON item.idtype = p_item.id WHERE desactif=0 order by ordre;");
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

<div class="container col">
    <ul class="collection">
        <?php for($i=0; $i<sizeof($itemsId); $i++){?>
                <li class="collection-item avatar" style="padding-left:100px;min-height:95px;padding-right:56px;">
                    <a style="color:black;" href="admin-plat?id=<?php echo $itemsId[$i]; ?>">
                        <div class="circle" style="background-image:url('<?php if( $itemsImg[$i]!=null and  $itemsImg[$i]!=""){ echo "upload/".$itemsImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center; background-repeat:no-repeat;border:2px solid white;background-size:auto 100px;border-radius:20px;width:70px;height:70px;margin-top:-10px;" alt="<?php echo ucfirst(strtolower($itemsBdTitre[$i])); ?>" >
                        </div>
                        <span class="title">
                            <?php echo ucfirst(strtolower($itemsTitre[$i])); ?>
                        </span>
                        <br/>
                        <span class="<?php echo $_GLOBAL['couleur2a']; ?>-text" style="font-size:14px;font-style: italic;">
                            <?php echo ucfirst(strtolower($itemsType[$i])); ?>
                        </span><br/>
                        <span style="font-size:85%;">
                            <?php echo $itemsDesc[$i]; ?>
                        </span>
                        <!-- Modal Structure -->
                        <div id="modalDelItem<?php echo $i; ?>" class="modal">
                            <div class="modal-content">
                                <h4>Retirer un plat</h4>
                                <p><h5>Etes-vous certain de vouloir retirer ce plat?</h5>
                                <b>Titre:</b> <?php echo ucfirst(strtolower($itemsTitre[$i])); ?><br/>
                                <b>Type:</b> <?php echo ucfirst(strtolower($itemsType[$i])); ?><br/>
                                <b>Prix:</b> <?php echo money_format('%(#10n', ($itemsPrix[$i])); ?>
                            </div>
                            <div class="modal-footer">
                                <a href="admin-plat-validation?idout=<?php echo $itemsId[$i]; ?>" class="btn modal-action modal-close waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>">Oui</a>
                                <a class="modal-action modal-close waves-effect waves-light btn-flat"><b>Non, annuler</b></a>
                            </div>
                        </div>

                        <a class="secondary-content <?php echo $_GLOBAL['couleur2a']; ?>-text" style="padding-top:18px;font-size:90%;"><br/><?php echo money_format('%(#10n', ($itemsPrix[$i])); ?></a>
                        <a href="#modalDelItem<?php echo $i; ?>" style="margin-top:-6px;" class="btn-floating <?php echo $_GLOBAL['couleur1a']; ?> secondary-content"><i class="material-icons">delete</i></a>
                    </a>
                </li>
                <?php
            }?>
    </ul>
</div>

<script type="text/javascript">
    $('.modal').modal();
</script>