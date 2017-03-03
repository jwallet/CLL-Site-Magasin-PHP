<div class="container">
    <div class="section">
        <form class="row" action="admin-plat-ajout-validation" method="POST" enctype="multipart/form-data">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="plat-titre" id="titre" class="validate" required>
                    <label>Titre du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">description</i>
                    <input type="text" name="plat-description" id="description" class="validate" required>
                    <label>Description du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">attach_money</i>
                    <input type="number" step="any" min="0" name="plat-prix" id="plat-prix" pattern="\d+(.\d{2})?" title="9.99" class="validate" required>
                    <label>Prix du plat</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">restaurant_menu</i>
                    <select name="plat-type" required>
                        <option value="" disabled selected>Choisir un type de plat</option>
                        <?php
                        $stmt = $mysqli->prepare("SELECT id,type FROM p_item order by type;");
                        $stmt->execute();
                        $stmt->bind_result($id,$type);
                        while($stmt->fetch()) {
                            echo "<option value=\"$id\">$type</option>";
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
                            <input name="plat-image" id="plat-image" type="file" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="IMAGE" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b']?> "
                            type='submit' name="ajoutplat">Ajouter le plat</button>
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