<div class="container">
    <br/>
    <h5>Pour commander, veuillez vous connecter.</h5>
    <br/>
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
            <button style="width: 100%;" class="waves-effect waves-light btn-large deep-orange accent-2"
               type='submit' name="connect">Se connecter</button>
        </div>
    </form>
</div>