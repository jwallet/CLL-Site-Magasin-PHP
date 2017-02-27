<?php
    if(isset($_SESSION['user-isadmin'])){
    $isadmin = $_SESSION['user-isadmin'];
}?>
<ul class="collapsible" data-collapsible="accordion">
    <?php if (!$isadmin){ ?>
        <!-- commandes -->
        <li>
            <a href="#" class="black-text">
                <div class="collapsible-header">
                    <div class="container">
                        <span class="badge">4</span>
                        <i class="material-icons">shopping_basket</i>Commandes
                    </div>
                </div>
            </a>
        </li>
    <?php } ?>


    <!-- messagerie -->
    <li>
        <a href="#" class="black-text">
        <div class="collapsible-header">
            <div class="container">
                <span class="badge">7</span>
                <span class="new badge  <?php echo $_GLOBAL['couleur1'] ?>" data-badge-caption="nouveaux">4</span>
                <i class="material-icons">message</i>Messagerie
            </div>
        </div>
        </a>
    </li>

    <?php if (!$isadmin){ ?>
    <!-- profil -->
    <li>
        <a href="#" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">person</i>
                    Modifier mes informations personnelles
                </div>
            </div>
        </a>
    </li>
    <?php } ?>

    <!-- changer password -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">lock</i>Changer mon mot de passe
            </div>
        </div>
        <div class="collapsible-body">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-changed.php" class="col s12" method="post">
                    <div class="input-field row">
                        <input type="password" name="old" id="old" required>
                        <label for="old">Mot de passe actuel</label>
                    </div>
                    <div class="input-field row">
                        <input type="password" name="new1" id="new1" minlength="6" class="validate" required>
                        <label for="new2">Nouveau mot de passe</label>
                    </div>
                    <div class="input-field row">
                        <input type="password" name="new2" id="new2" minlength="6" class="validate" required>
                        <label for="new2">Nouveau mot de passe</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>

    <script type="text/javascript">
        var password = document.getElementById("new1")
            , confirm_password = document.getElementById("new2");
        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Mot de passe ne correspond pas");
            } else {
                confirm_password.setCustomValidity('');
                confirm_password.removeClass("invalid").addClass("valid");
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>

    <!-- deconnexion -->
    <li>
        <a href="account-disconnect.php" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">screen_share</i>Déconnexion
                </div>
            </div>
        </a>
    </li>
</ul>