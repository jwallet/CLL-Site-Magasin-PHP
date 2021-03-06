<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'plat-ajout'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le plat a été ajouté', 3000);
            });
        </script>
        <?php
    }
    elseif($_SESSION['toast'] == 'erreur-plat'){?>
    <script type="text/javascript">
        $(document).ready(function () {
            Materialize.toast('La modification du plat a échoué', 3000);
        });
    </script>
    <?php
    }
    elseif ($_SESSION['toast'] == 'client-ajout'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le client a été ajouté', 3000);
            });
        </script>
        <?php
    }
    elseif ($_SESSION['toast'] == 'menu-next-added'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le prochain menu a été ajouté', 3000);
            });
        </script>
        <?php
    }
    elseif ($_SESSION['toast'] == 'menu-next-updated'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le prochain menu a été mis à jour', 3000);
            });
        </script>
        <?php
    }
    elseif ($_SESSION['toast'] == 'menu-now-updated'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Le menu actuel a été mis à jour', 3000);
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
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1a'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">shopping_basket</i>Commandes
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-commande-statistique" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Statistique des commandes
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-commande-list" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Gérer une commande de client
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- menus -->
    <!--permet de gerer le titre d'un menu et d'associer des plats a celui-ci.-->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1a'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">map</i>Menu
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-menu?next" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Rédiger le prochain menu
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-menu?current" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Modifier le menu actuel
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Les plats / items -->
    <!-- permet de gerer tous les types de plats-->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1a'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">restaurant</i>Plats
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-plat" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Ajouter un nouveau plat
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-plat-list" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Gérer un plat existant
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-plat-type" class="black-text">
                        <div class="collapsible-header grey lighten-3">
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
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1a'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">person</i>Compte clients
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-client" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Ajouter un nouveau compte client
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-client-list" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Gérer un compte client existant
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- pages web -->
    <li>
        <div class="collapsible-header">
            <div class="container">
                <span class="secondary-content"><i class="material-icons <?php echo $_GLOBAL['couleur1a'] ?>-text">keyboard_arrow_down</i></span>
                <i class="material-icons">dvr</i>Modifier pages d'infos
            </div>
        </div>
        <div class="collapsible-body" style="padding:0;">
            <ul class="collapsible" data-collapsible="accordion">
                <li>
                    <a href="admin-pages-entreprise" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Boîte à Bouf
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-pages-faq" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Fonctionnement (FAQ)
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-pages-termes" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Termes et conditions
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="admin-pages-dialogues" class="black-text">
                        <div class="collapsible-header grey lighten-3">
                            <div class="container">
                                <i class="material-icons"></i>Dialogues d'acceptation
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <!-- ecrire courriel general -->
<!--    <li>-->
<!--        <a href="#" class="black-text">-->
<!--            <div class="collapsible-header">-->
<!--                <div class="container">-->
<!--                    <i class="material-icons">email</i>Ecrire à tous les clients-->
<!--                </div>-->
<!--            </div>-->
<!--        </a>-->
<!--    </li>-->

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