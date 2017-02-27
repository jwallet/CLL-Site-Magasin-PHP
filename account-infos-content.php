<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="col m6 s12">
                    <div class="col s4"><b>Prénom</b></div>
                    <div class="col s8">val</div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Nom</b></div>
                    <div class="col s8">val</div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Courriel</b></div>
                    <div class="col s8">val</div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Téléphone</b></div>
                    <div class="col s8">val</div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Adresse</b></div>
                    <div class="col s8">valvalvalval valval valval vavalvalvalvalvalvallvalvalval val</div>
                </div>
            </div>

        </div>
    </div>
</div>
<ul class="collapsible" data-collapsible="accordion">
    <!-- changer nom prenom -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">person</i>Modifier mon prénom et nom
            </div>
        </div>
        <div class="collapsible-body">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-changed" class="col s12" style="margin:0;padding:0;" method="post">
                    <div class="input-field row">
                        <input type="text" name="prenom" id="prenom" required>
                        <label for="prenom">Prénom</label>
                    </div>
                    <div class="input-field row">
                        <input type="text" name="nom" id="nom" required>
                        <label for="nom">Nom</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>
    <!-- changer email -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">email</i>Modifier mon courriel
            </div>
        </div>
        <div class="collapsible-body">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-changed" class="col s12" style="margin:0;padding:0;" method="post">
                    <div class="input-field row">
                        <input type="email" name="email" id="email" required>
                        <label for="email">Courriel</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>
    <!-- changer telephone -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">phone</i>Modifier mon téléphone
            </div>
        </div>
        <div class="collapsible-body">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-changed" class="col s12" style="margin:0;padding:0;" method="post">
                    <div class="input-field row">
                        <input type="tel" name="telephone" id="telephone" required>
                        <label for="telephone">Téléphone</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>
    <!-- changer telephone -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <i class="material-icons">home</i>Modifier mon adresse
            </div>
        </div>
        <div class="collapsible-body">
            <div class="container row" style="margin-bottom:0; margin-top:0; padding:0;line-height: 0;">
                <form action="account-password-changed" class="col s12" style="margin:0;padding:0;" method="post">
                    <div class="input-field row">
                        <input type="text" name="adresse" id="adresse" required>
                        <label for="adresse">Adresse</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1'] ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>
</ul>
