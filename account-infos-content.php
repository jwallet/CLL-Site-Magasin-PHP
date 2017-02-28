<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="col m6 s12">
                    <div class="col s4"><b>Prénom</b></div>
                    <div class="col s8"><?php echo $_SESSION['user-prenom']?></div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Nom</b></div>
                    <div class="col s8"><?php echo $_SESSION['user-nom']?></div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Courriel</b></div>
                    <div class="col s8"><?php echo $_SESSION['user-email']?></div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Téléphone</b></div>
                    <div class="col s8"><?php echo $_SESSION['user-telephone']?></div>
                </div>
                <div class="col m6 s12">
                    <div class="col s4"><b>Adresse</b></div>
                    <div class="col s8"><?php echo $_SESSION['user-adresse']?></div>
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
                        <input type="text" name="prenom" id="prenom"
                               title="Lettres seulement"  pattern="[a-zA-Z]+" value="<?php echo $_SESSION['user-prenom']?>" required>
                        <label for="prenom">Prénom</label>
                    </div>
                    <div class="input-field row">
                        <input type="text" name="nom" id="nom"
                               title="Lettres seulement"  pattern="[a-zA-Z]+" value="<?php echo $_SESSION['user-nom']?>" required>
                        <label for="nom">Nom</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1']; ?>" type="submit" name="action">Enregistrer
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
                        <input type="email" name="email" id="email" value="<?php echo $_SESSION['user-email']?>" required>
                        <label for="email">Courriel</label>
                    </div>
                    <div class="input-field row">
                        <input type="password" name="oldpassword" id="old" required>
                        <label for="old">Mot de passe actuel</label>
                    </div>
                    <button class="btn waves-effect waves-light row right <?php echo $_GLOBAL['couleur1']; ?>" type="submit" name="action">Enregistrer
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
                        <input type="tel" name="telephone" id="telephone"
                               title="999 999-9999" pattern="^([0-9]{3} |[0-9]{3}-)[0-9]{3}-[0-9]{4}$" class="validate" value="<?php echo $_SESSION['user-telephone']?>" required>
                        <label for="telephone">Téléphone</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1']; ?>" type="submit" name="action">Enregistrer
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
                        <input type="text" name="adresse" id="adresse" value="<?php echo $_SESSION['user-adresse']?>" required>
                        <label for="adresse">Adresse</label>
                    </div>
                    <button class="btn waves-effect waves-light row right  <?php echo $_GLOBAL['couleur1']; ?>" type="submit" name="action">Enregistrer
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        </div>
    </li>
</ul>
