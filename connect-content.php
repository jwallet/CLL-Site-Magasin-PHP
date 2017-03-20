<!-- verification si user est connecte, dun coup qui tape l'adresse a main, sinon redirection vers son compte -->
<?php if(isset($_SESSION['user-online'])){
    //Variable session de l'user
    if($_SESSION['user-online']==true){
        header ("Location: account");
    }
}

if(isset($_SESSION['toast'])) {
    //Toast de fail connexion
    if($_SESSION['toast']=='login-failed'){
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Courriel ou mot de passe invalide.', 3000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
} ?>
<!--Affichage à l'écran de connexion-->
<div class="container">
    <div class="section">
        <form action="connect-validation" method="post">
                <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="icon_email" type="email" name="email" id="email" class="validate" required>
                    <label for="icon_email">Courriel</label>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                    <input id="icon_password" type="password" name="password" id="password" class="validate" required>
                    <label for="icon_password">Mot de passe</label>
                </div>
                <button style="width: 94%; margin-left:3%; margin-right: 3%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a']; if(!isset($_COOKIE['cookiesaccepted'])){echo " disabled";}?>"
                   type='submit' name="connect"><?php if(!isset($_COOKIE['cookiesaccepted'])){echo "Vous devez accepter les cookies";}else{ echo "Se connecter";}?></button>
        </form>
    </div>
</div>