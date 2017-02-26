<div class="container">
    <br/>
    <form class="col s12" action="connect-validation.php" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input name="email" id="plat-titre" class="validate">
                <label>Titre du plat</label>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <i class="material-icons prefix">mode_edit</i>
                    <textarea id="icon_prefix2" class="materialize-textarea"></textarea>
                    <label for="icon_prefix2">Description du plat</label>
                </div>
            </div>
            <div class="input-field col s12">
                <input id="plat-prix" class="validate">
                <label>Prix du plat</label>
            </div>
        </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Ajouter une photo</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        <div class="s12">
            <button style="width: 100%;" class="waves-effect waves-light btn-large deep-orange accent-2"
                    type='submit' name="connect">Ajouter le plat</button>
        </div>
    </form>
</div>
<?php

?>