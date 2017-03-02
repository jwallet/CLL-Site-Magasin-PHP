<?php
$stmt = $mysqli->prepare("SELECT item.titre,p_item.type,description,prix,image FROM item,p_item where item.idtype = p_item.id and item.id=?;");
$stmt->bind_param("i",$_GET['id']);
$stmt->execute();
if($stmt->fetch()){
    $stmt->bind_result($modtitre,$modtyperepas,$moddescription,$modprix,$modimage);
    echo $modtitre;
    echo "<br>";
    echo $modtyperepas;
    echo "<br>";
    echo $moddescription;
    echo "<br>";
    echo $modprix;
    echo "<br>";
    echo $modimage;
    echo "<br>";
    $stmt->free_result();
    $stmt->close();
}
else
{echo "erreur";}
?>
<div class="container">
    <div class="section">
        <form class="row" action="admin-plat-ajout-validation" method="POST" enctype="multipart/form-data">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="mod-titre" id="mod-titre" class="validate" required>
                    <label><?php echo $modtitre; ?></label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">description</i>
                    <input type="text" name="mod-description" id="mod-description" class="validate" required>
                    <label><?php echo $moddescription; ?></label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">attach_money</i>
                    <input type="number" step="any" min="0" name="mod-prix" id="mod-prix" pattern="\d+(.\d{2})?" title="9.99" class="validate" required>
                    <label><?php echo $modprix;?></label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">restaurant_menu</i>
                    <select name="mod-type" required>
                        <option value="" disabled selected>Choisir un type de plat</option>
                        <?php
                        $stmt = $mysqli->prepare("SELECT id,type FROM p_item order by type;");
                        $stmt->execute();
                        $stmt->bind_result($id,$type);
                        while($stmt->fetch())
                        {
                            echo $modtyperepas;
                            echo "<br>";
                            echo $type;
                            echo "<br>";
                            if($type == $modtyperepas){
                                echo "<option value=\"$id\">$type</option>";
                            }
                            else{
                                echo "<option value=\"$id\">$type</option>";
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
                            <input value="<?php echo $modimage?>" $image name="mod-image" id="mod-image" type="file" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="IMAGE" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?> "
                            type='submit' name="modplat">Appliquer les modifications</button>
                </div>
            </div>
        </form>
    </div>
</div>
