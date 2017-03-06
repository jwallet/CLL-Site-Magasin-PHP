<?php
$stmt = $mysqli->prepare("SELECT item.titre,p_item.type,description,prix,image FROM item,p_item where item.idtype = p_item.id and item.id=?;");
$stmt->bind_param("i",$_GET['id']);
$stmt->execute();
$stmt->bind_result($modtitre, $modtyperepas, $moddescription, $modprix, $modimage);
if($stmt->fetch()) {
//    echo $modtitre;
//    echo "<br>";
//    echo $modtyperepas;
//    echo "<br>";
//    echo $moddescription;
//    echo "<br>";
//    echo $modprix;
//    echo "<br>";
//    echo $modimage;
//    echo "<br>";
}
$stmt->free_result();
$stmt->close();
?>
<div class="container">
    <div class="section">
        <form class="row" action="admin-plat-mod-validation?id=<?php echo $_GET['id']?>" method="POST" enctype="multipart/form-data">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="mod-titre" id="mod-titre" value="<?php echo $modtitre; ?>" class="validate" required>
                    <label>Titre du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">description</i>
                    <input type="text" name="mod-description" id="mod-description" value="<?php echo $moddescription; ?>" class="validate" required>
                    <label>Description du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">attach_money</i>
                    <input type="number" step="any" min="0" name="mod-prix" id="mod-prix" value="<?php echo $modprix;?>" pattern="\d+(.\d{2})?" title="9.99" class="validate" required>
                    <label>Prix du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">restaurant_menu</i>
                    <select name="mod-type" required>
                        <option value="" disabled selected>Choisir un type de plat</option>
                        <?php
                        $stmt = $mysqli->prepare("SELECT id,type FROM p_item order by type;");
                        $stmt->execute();
                        $stmt->bind_result($idtype,$type);
                        while($stmt->fetch())
                        {
                            echo $modtyperepas;
                            echo "<br>";
                            echo $type;
                            echo "<br>";
                            if($type == $modtyperepas){
                                echo "<option value=\"$idtype\" selected>$type</option>";
                           }
                           else{
                               echo "<option value=\"$idtype$id\">$type</option>";
                           }
                        }
                        $stmt->free_result();
                        $stmt->close();
                        ?>
                    </select>
                    <label>Type de plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix" style="margin-top:10px;">add_a_photo</i>
                    <div class="file-field input-field" style="padding-left:30px;">
                        <div class="btn right">
                            <span>Parcourir</span>
                            <input value="<?php echo $modimage?>" name="mod-image" id="mod-image" type="file" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" value="<?php echo $modimage; ?>"name="mod-image-txt" id="mod-image-txt" placeholder="IMAGE" type="text">
                        </div>
                    </div>
                </div>
<!--                <div class="row center">-->
<!--                    <img src="--><?php
//                    if(isset($modimage)){
//                        echo $_GLOBAL['dirimg'].$modimage;
//                    }
//                    ?><!--" class="circle responsive-img" alt="Aucune image" style="width:256px;height:256px">-->
<!--                </div>-->
                <div class="col s12">
                    <div class="card-panel grey lighten-5 z-depth-1">
                        <div class="row valign-wrapper">
                            <div class="col s4">
                                <img src="<?php
                                if(isset($modimage)){
                                    echo $_GLOBAL['dirimg'].$modimage;
                                }
                                ?>" class="circle responsive-img" alt="Aucune image">
                            </div>
                            <div class="col s10">
                              <span class="black-text">
                                Aperçu de l'image associé a ce plat
                              </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b']?> "
                            type='submit' name="modplat">Appliquer les modifications</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
    });
</script>
