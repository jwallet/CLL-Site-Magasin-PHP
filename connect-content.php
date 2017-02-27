<!-- verification si user est connecte, dun coup qui tape l'adresse a main, sinon redirection vers son compte -->
<?php if(isset($_SESSION['user-online'])){
    if($_SESSION['user-online']==true){
        header ("Location: account");
    }
}

if(isset($_SESSION['toast'])) {
    if($_SESSION['toast']=='login-failed'){
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Courriel ou mot de passe invalide.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}?>

<div class="container">
    <div class="section">
        <form class="row" action="connect-validation" method="post">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">email</i>
                    <input id="icon_email" type="email" name="email" id="email" class="validate">
                    <label for="icon_email">Courriel</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">lock</i>
                    <input id="icon_password" type="password" name="password" id="password" class="validate">
                    <label for="icon_password">Mot de passe</label>
                </div>
            </div>
            <div class="s12">
                <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?>"
                   type='submit' name="connect">Se connecter</button>
            </div>
        </form>
    </div>
</div>