<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'client-ajout-existe'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('L\'ajout a échoué. Ce courriel est déjà enregistré.', 8000);
            });
        </script>
    <?php }elseif($_SESSION['toast'] == 'client-ajout-erreurmail'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('L\'envoie du courriel a échoué. Veuillez réessayer plus tard.', 8000);
            });
        </script>
    <?php }
    unset($_SESSION['toast']);
    }
?>
<?php if(isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT email,prenom,nom,telephone,adresse FROM personne WHERE personne.id=?;");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->bind_result($email, $prenom, $nom, $telephone, $adresse);
    $id =  $_GET['id'];
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();
}
else{
    $id = "";
    $prenom = "";
    $nom = "";
    $telephone = "";
    $adresse = "";
    $email = "";
}
?>
<div class="container">
    <div class="section">
        <form action="admin-client-validation" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <div class="input-field">
                <i class="material-icons prefix">email</i>
                <input id="email" name="email" type="email" value="<?php echo $email; ?>" class="validate" required>
                <label for="email">Courriel *</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input id="prenom" name="prenom" type="text" value="<?php echo $prenom; ?>" title="Lettres seulement"  pattern="[a-zA-Z]+" class="validate">
                <label for="prenom">Prénom</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">person</i>
                <input id="nom" name="nom" type="text" value="<?php echo $nom; ?>" title="Lettres seulement" pattern="[a-zA-Z]+" class="validate">
                <label for="nom">Nom</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">phone</i>
                <input id="telephone" name="telephone"
                       type="tel" title="(999) 999-9999" value="<?php echo $telephone; ?>" pattern="^([0-9]{3} |[0-9]{3}-)[0-9]{3}-[0-9]{4}$" class="validate">
                <label for="telephone">Telephone</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">home</i>
                <input type="text" value="<?php echo $adresse; ?>" name="adresse" id="adresse">
                <label for="adresse">Adresse</label>
            </div>
            <button style="width: 100%;" id="send" class="waves-effect waves-light btn-large  <?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b']?>" type="submit" name="action">Enregistrer
            </button>
        </form>
    </div>
</div>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("#mainProgressBar").removeClass('hide');
    }
</script>