<?php if(isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT item.titre,p_item.type,description,prix,image FROM item LEFT JOIN p_item ON item.idtype = p_item.id WHERE item.id=?;");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->bind_result($titre, $typerepas, $description, $prix, $image);
    $id =  $_GET['id'];
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
} else{
    $id = "";
    $titre = "";
    $typerepas = "";
    $description = "";
    $prix = 0;
    $image = "";
}
?>

<div class="container">
    <div class="section">
        <form action="admin-plat-validation" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-field">
                <i class="material-icons prefix">title</i>
                <input type="text" name="titre" value="<?php echo ucfirst(strtolower($titre)); ?>" class="validate" required>
                <label>Titre du plat</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">description</i>
                <input type="text" name="description" value="<?php echo $description; ?>" class="validate">
                <label>Description du plat</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">attach_money</i>
                <input type="number" step="0.01" min="0" name="prix" value="<?php echo number_format($prix,2,".","");?>" pattern="\d+(.\d{2})?" title="9.99" class="validate" required>
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
                        <div class="card-image" alt="<?php echo ucfirst(strtolower($titre)); ?>"
                             style="height:280px;width:100%;background-size:100% auto;background-position:center;background-repeat: no-repeat;
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