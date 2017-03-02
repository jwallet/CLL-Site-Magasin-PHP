<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'client-ajout-existe'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('le email existe déja', 8000);
            });
        </script>
    <?php }elseif($_SESSION['toast'] == 'client-ajout-erreurmail'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Un erreur a eu lieu lors de l\'envoi du mail. Veuillez réessayer plus tard', 8000);
            });
        </script>
    <?php }
    unset($_SESSION['toast']);
}
?>
<div class="container">
    <div class="section">
        <form class="row" action="admin-plat-modtype-validation" method="POST">
            <div class="input-field row">
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
            <div class="input-field row">
                <i class="material-icons prefix">description</i>
                <input type="text" name="plat-ntype" id="platntype" class="validate" required>
                <label>Veuillez choisir un nouveau titre pour le type de plat sélectionné</label>
            </div>
            <div class="row">
                <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?> "
                        type='submit' name="ajoutplat">Modifier</button>
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