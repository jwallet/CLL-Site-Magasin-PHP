<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'plat-type-mod'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Modification a réussi', 3000);
            });
        </script>
    <?php }elseif($_SESSION['toast'] == 'plat-type-add'){ ?>
            <script type="text/javascript">
                    $(document).ready(function () {
                    Materialize.toast('Ajout a réussi', 3000);
                    });
            </script>
    <?php }
    unset($_SESSION['toast']);
}
?>
<div class="container">
    <div class="section">
        <form action="admin-plat-modtype-validation" method="POST">
            <div class="input-field">
                <i class="material-icons prefix">restaurant_menu</i>
                <select name="plat-atype" required>
                    <option value="" disabled selected>Choisir un type de plat</option>
                    <?php
                    $stmt = $mysqli->prepare("SELECT id,type FROM p_item order by type;");
                    $stmt->execute();
                    $stmt->bind_result($id,$type);
                    while($stmt->fetch()) {
                        echo "<option value=\"$id\">$type</option>";
                    }
                    $stmt->close();
                    ?>
                </select>
                <label>Type de plat</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">update</i>
                <input type="text" name="plat-ntype" id="platntype" class="validate" required>
                <label>Veuillez choisir un nouveau titre pour le type de plat sélectionné</label>
            </div>
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] ?> "
                        type='submit' name="modtype">Modifier</button>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="section">
        <form action="admin-plat-modtype-validation" method="POST">
            <div class="input-field">
                <i class="material-icons prefix">add</i>
                <input type="text" name="plat-addtype" id="plataddtype" class="validate" required>
                <label>Inscrivez le nouveau type de repas ici</label>
            </div>
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] ?> "
                        type='submit' name="addtype">Ajouter</button>
    </div>
    </form>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
    });
</script>