<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'ajout-plat-erreur'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Il y a eu un erreur lors de lajout du plat, 8000);
            });
        </script>
    <?php } unset($_SESSION['toast']);
}
?>
<div class="container">
    <br>
    <div class="row">
        <form class="col s12" action="admin-client-ajout-validation" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">email</i>
                    <input id="icon_email" name="email" type="email" class="validate" required>
                    <label for="icon_email">Email (*)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prenom" name="prenom" type="text" class="validate">
                    <label for="icon_prenom">Prénom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_Nom" name="nom" type="text" class="validate">
                    <label for="icon_Nom">Nom</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">phone</i>
                    <input id="icon_telephone" name="telephone" type="tel" class="validate">
                    <label for="icon_telephone">Telephone</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light right" type="submit" name="action">Inscrire
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
</div>
<!-- Table des clients à faire-->
<!--<table class="highlight">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th data-field="id">Name</th>-->
<!--        <th data-field="name">Item Name</th>-->
<!--        <th data-field="price">Item Price</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!---->
<!--    <tbody>-->
<!--    <tr>-->
<!--        <td>Alvin</td>-->
<!--        <td>Eclair</td>-->
<!--        <td>$0.87</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Alan</td>-->
<!--        <td>Jellybean</td>-->
<!--        <td>$3.76</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td>Jonathan</td>-->
<!--        <td>Lollipop</td>-->
<!--        <td>$7.00</td>-->
<!--    </tr>-->
<!--    </tbody>-->
<!--</table>-->
<?php

?>