<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'plat-ajout'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le plat a été ajouté avec succès', 8000);
            });
        </script>
        <?php
    }
    elseif ($_SESSION['toast'] == 'client-ajout'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le client a été ajouté avec succès', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
?>
<ul class="collapsible" data-collapsible="accordion">
    <!-- Commandes -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">shopping_basket</i>Commandes
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Voir les commandes recues
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Archives des commandes
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="collapsible-header grey lighten-5">
                        <div class="container">
                            <i class="material-icons"></i>Gérer une commande de client
                            <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1'] ?>-text">keyboard_arrow_down</i></span>
                        </div>
                    </div>
                    <div class="collapsible-body" style="padding:0;">
                        <ul class="collapsible" data-collapsible="accordion">
                            <li>
                                <a href="#" class="black-text">
                                    <div class="collapsible-header grey lighten-3">
                                        <div class="container">
                                            <i class="material-icons"></i>Voir une commande
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="black-text">
                                    <div class="collapsible-header grey lighten-3">
                                        <div class="container">
                                            <i class="material-icons"></i>Modifier une commande
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="black-text">
                                    <div class="collapsible-header grey lighten-3">
                                        <div class="container">
                                            <i class="material-icons"></i>Retirer une commande
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>


    <!-- menus -->
    <!--permet de gerer le titre d'un menu et d'associer des plats a celui-ci.-->
    <li>
        <a href="#" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">map</i>Menus
                </div>
            </div>
        </a>
    </li>

    <!-- Les plats / items -->
    <!-- permet de gerer tous les types de plats-->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">restaurant</i>Plats
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-plat-ajout" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Ajouter un nouveau plat
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Modifier un plat
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Supprimer un plat
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Modifier la liste des types de plat
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- comptes -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">person</i>Compte clients
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Rechercher un compte client
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-client-ajout" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Ajouter un nouveau compte client
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Modifier un compte client
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Désactiver un compte client
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- ecrire courriel general -->
    <li>
        <a href="#" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">email</i>Ecrire à tous les clients
                </div>
            </div>
        </a>
    </li>

    <!-- pages web -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">dvr</i>Modifier pages d'infos
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>A propos de l'entreprise
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Nous contacter
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Fonctionnement (FAQ)
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="black-text">
                        <div class="collapsible-header grey lighten-5">
                            <div class="container">
                                <i class="material-icons"></i>Termes et conditions
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- sortie panneau admin -->
    <li>
        <a href="home" class="black-text">
            <div class="collapsible-header">
                <div class="container">
                    <i class="material-icons">screen_share</i>Sortir du panneau administration
                </div>
            </div>
        </a>
    </li>
</ul>