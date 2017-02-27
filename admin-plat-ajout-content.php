<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'ajout-plat-erreur'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Il y a eu un erreur lors de lajout du plat, 8000);
            });
        </script>
    <?php } unset($_SESSION['toast']);
    }
?>
<div class="container">
    <br>
    <form class="col s12" action="admin-plat-ajout-validation" method="POST">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="plat-titre" id="titre" class="validate" required>
                <label>Titre du plat</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="plat-description" id="description" class="validate" required>
                <label>Description du plat</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="number" name="plat-prix" id="plat-prix" class="validate" required>
                <label>Prix du plat</label>
            </div>
        </div>
        <div class="row">
            <label>Type de plat</label>
            <select name="plat-type" required class="browser-default">
                <option value="" disabled selected>Choisir un type de plat</option>
                <?php
                $stmt = $mysqli->prepare("SELECT id,type FROM p_item;");
                $stmt->execute();
                $stmt->bind_result($id,$type);
                while($stmt->fetch()) {
                    ?>
                    <option value="<?php echo $id; ?>"><?php echo $type; ?></option><?php
                }
                $stmt->close();
                ?>
            </select>
        </div>
        <div class="row">
            <div class="file-field input-field">

                <div class="btn">
                    <span>Ajouter une photo</span>
                    <input name="plat-image" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?> "
                    type='submit' name="ajoutplat">Ajouter le plat</button>
        </div>
    </form>
</div>