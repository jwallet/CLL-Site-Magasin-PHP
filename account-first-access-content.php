<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'first-access-failed') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Veuillez remplir les champs.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
?>
<div class="container">
    <div class="section">
        <form class="row" action="account-first-access-validation" method="post">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">email</i>
                    <input type="email" name="email" id="email"
                           value="<?php echo $_SESSION['user-email']?>" readonly>
                    <label for="email">Courriel</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="prenom" id="prenom" title="Lettres seulement"  pattern="[a-zA-Z]+"
                           value="<?php echo $_SESSION['user-prenom']?>" required>
                    <label for="prenom">Prénom</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="nom" id="nom" title="Lettres seulement"  pattern="[a-zA-Z]+"
                           value="<?php echo $_SESSION['user-nom']?>" required>
                    <label for="nom">Nom</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">phone</i>
                    <input type="tel" name="telephone" id="telephone"
                           title="999 999-9999" pattern="^([0-9]{3} |[0-9]{3}-)[0-9]{3}-[0-9]{4}$" class="validate"
                           value="<?php echo $_SESSION['user-telephone']?>" required>
                    <label for="telephone">Téléphone</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">home</i>
                    <input type="text" name="adresse" id="adresse" value="<?php echo $_SESSION['user-adresse']?>">
                    <label for="adresse">Adresse</label>
                </div>
                <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?>"
                        type='submit' name="connect">Enregistrer</button>
            </div>
        </form>
    </div>
</div>