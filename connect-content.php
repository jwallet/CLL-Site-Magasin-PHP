<!-- verification si user est connecte, dun coup qui tape l'adresse a main, sinon redirection vers son compte -->
<?php if(isset($_SESSION['user-online'])){
    if($_SESSION['user-online']==true){
        header ("Location: account.php");
    }
}?>

<div class="container">
    <br/>

    <?php if(isset($_GET['erreur'])) {
        echo "<p class='red-text'>Courriel ou mot de passe invalide.</p>";
    }?>
    <form class="col s12" action="connect-validation.php" method="post">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input id="icon_email" type="email" name="email" id="email" class="validate">
                <label for="icon_email">Courriel</label>
            </div>
            <div class="input-field col s12">
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