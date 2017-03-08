<?php if(isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT item.titre,p_item.type,description,prix,image FROM item,p_item where item.idtype = p_item.id and item.id=?;");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->bind_result($titre, $typerepas, $description, $prix, $image);
    $id =  $_GET['id'];
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
}
else{
    $id = "";
    $titre = "";
    $typerepas = "";
    $description = "";
    $prix = "";
    $image = "";
}
?>
<div id="modalsup" name="modalsup" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
<div class="container">
    <div class="section">
        <form action="admin-plat-validation" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <div class="input-field">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="titre" value="<?php echo $titre; ?>" class="validate" required>
                    <label>Titre du plat</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">description</i>
                    <input type="text" name="description" value="<?php echo $description; ?>" class="validate" required>
                    <label>Description du plat</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">attach_money</i>
                    <input type="number" step="any" min="0" name="prix" value="<?php echo $prix;?>" pattern="\d+(.\d{2})?" title="9.99" class="validate" required>
                    <label>Prix du plat</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">restaurant_menu</i>
                    <select name="type" required>
                        <option value="" disabled selected>Choisir un type de plat</option>
                        <?php
                        $stmt = $mysqli->prepare("SELECT id,type FROM p_item order by type;");
                        $stmt->execute();
                        $stmt->bind_result($idtype,$type);
                        while($stmt->fetch())
                        {
                            echo $typerepas;
                            echo "<br>";
                            echo $type;
                            echo "<br>";
                            if($type == $typerepas){
                                echo "<option value=\"$idtype\" selected>$type</option>";
                            }
                            else{
                                echo "<option value=\"$idtype\">$type</option>";
                            }
                        }
                        $stmt->free_result();
                        $stmt->close();
                        ?>
                    </select>
                    <label>Type de plat</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix" style="margin-top:10px;">add_a_photo</i>
                    <div class="file-field input-field" style="padding-left:30px;">
                        <div class="btn right <?php echo $_GLOBAL['couleur1a']?>">
                            <span>Parcourir</span>
                            <input name="image" type="file" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="image-txt" placeholder="IMAGE" type="text">
                        </div>
                    </div>
                </div>
                <?php if($id!="" and isset($image)){?>
                    <div class="center">
                        <div class="card center">
                            <span class="card-title">Image associée à ce plat</span>
                            <div class="card-image"
                             style="height:25%;width:100%;background-size:100% auto;background-position:center;
                                     background-image:url('<?php echo $_GLOBAL['dirimg'].$image; ?>');">
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a']?> "
                            type='submit'>Enregistrer</button>
            </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
    });
</script>