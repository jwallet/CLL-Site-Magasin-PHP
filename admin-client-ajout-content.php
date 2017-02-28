<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'client-ajout-existe'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('le email existe déja', 8000);
            });
        </script>
    <?php }elseif($_SESSION['toast'] == 'client-ajout-erreurmail'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Un erreur a eu lieu lors de l\'envoi du mail. Veuillez réessayer plus tard', 8000);
            });
        </script>
    <?php }
    unset($_SESSION['toast']);
    }
?>

<div class="container">
    <div class="section">
        <form class="row" action="admin-client-ajout-validation" method="post">
            <div class="col s12">
                <div class="input-field row">
                    <i class="material-icons prefix">email</i>
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">Courriel *</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">person</i>
                    <input id="prenom" name="prenom" type="text" title="Lettres seulement"  pattern="[a-zA-Z]+" class="validate">
                    <label for="prenom">Prénom</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">person</i>
                    <input id="nom" name="nom" type="text" title="Lettres seulement" pattern="[a-zA-Z]+" class="validate">
                    <label for="nom">Nom</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">phone</i>
                    <input id="telephone" name="telephone"
                           type="tel" title="(999) 999-9999" pattern="^([0-9]{3} |[0-9]{3}-)[0-9]{3}-[0-9]{4}$" class="validate">
                    <label for="telephone">Telephone</label>
                </div>
                <div class="input-field row">
                    <i class="material-icons prefix">home</i>
                    <input type="text" name="adresse" id="adresse">
                    <label for="adresse">Adresse</label>
                </div>
                <button style="width: 100%;" id="send" class="waves-effect waves-light btn-large  <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?>" type="submit" name="action">Inscrire
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("#mainProgressBar").removeClass('hide');
    }
</script>