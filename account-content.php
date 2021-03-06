<?php
$isadmin = false;
$isnew = false;
if(isset($_SESSION['user-isadmin'])){
    $isadmin = $_SESSION['user-isadmin'];
}
if(isset($_SESSION['user-isnew'])){
    $isnew = $_SESSION['user-isnew'];
}

if(isset($_SESSION['toast'])) {
    if($_SESSION['toast']=='password-changed-failed'){
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Impossible de modifier le mot de passe.', 3000);
            });
        </script>
        <?php
    }
    elseif($_SESSION['toast']=='password-changed'){
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Mot de passe modifié.', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}?>

<ul class="collapsible" data-collapsible="accordion">
    <?php if(!$isnew){
        if (!$isadmin){ ?>
            <!-- commandes -->
            <li>
                <a href="account-commandes" class="black-text">
                    <div class="collapsible-header">
                        <div class="container">
                            <i class="material-icons">shopping_basket</i>Commandes
                        </div>
                    </div>
                </a>
            </li>
        <?php } ?>

    <!-- profil -->
    <li>
        <a href="account-infos" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">person</i>
                    Mes informations personnelles
                </div>
            </div>
        </a>
    </li>

    <!-- changer password -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">lock</i>Changer mon mot de passe
            </div>
        </div>
        <div class="collapsible-body grey lighten-3">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-validation" class="col s12" method="post" style="margin:0;padding:0;">
                    <div class="input-field row">
                        <input type="password" name="oldpassword" id="old" required>
                        <label for="old">Mot de passe actuel</label>
                    </div>
                    <div class="input-field row">
                        <input type="password" name="new1password" id="new1" minlength="6" class="validate" required>
                        <label for="new1">Nouveau mot de passe</label>
                    </div>
                    <div class="input-field row">
                        <input type="password" name="new2password" id="new2" minlength="6" class="validate" required>
                        <label for="new2">Nouveau mot de passe</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1a'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>

    <script type="text/javascript">
        var w = document.getElementById("new1");
        var x = document.getElementById("new2");
        function validatePassword(){
            if(x.value != w.value) {
                x.setCustomValidity("Mot de passe ne correspond pas");
            } else {
                x.setCustomValidity('');
                $('#new2').removeClass("invalid");
            }
        }
        w.onchange = validatePassword;
        x.onkeyup = validatePassword;
    </script>
<?php } ?>
    <!-- deconnexion -->
    <li>
        <a href="account-disconnect" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">screen_share</i>Déconnexion
                </div>
            </div>
        </a>
    </li>
</ul>