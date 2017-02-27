<div class="container">
    <br/>
    <form class="col s12" action="admin-plat-validation" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="plat-titre" class="validate">
                <label>Titre du plat</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="plat-description" class="validate">
                <label>Description du plat</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input type="text" id="plat-prix" class="validate">
                <label>Prix du plat</label>
            </div>
        </div>
        <div class="row">
            <label>Type de plat</label>
            <select class="browser-default">
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
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row">
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?> "
                    type='submit' name="connect">Ajouter le plat</button>
        </div>
    </form>
</div>
<?php

?>