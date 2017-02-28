<?php
$fichier = explode("/", $_SERVER['PHP_SELF']);
$fichier = $fichier[count($fichier)-1];
//CONCAT(fichier,'.php') LIKE '$fichier'";
$sql = "SELECT * FROM w_pages_contenu WHERE CONCAT(fichier,'.php') LIKE '$fichier'";
$result = $mysqli->query($sql);
$page = $result->fetch_assoc();

//----------verification des acces---------------------------------------------------------
//verification si user est connecte et qui veut ouvrir la page connexion pareille = retour
if(isset($_SESSION['user-online'])){
    if($_SESSION['user-online']){
        if(!$_SESSION['user-isnew']) {
            //verification si user est admin pour acceder au panneau admin
            if ($page['categorie'] == "admin" and !$_SESSION['user-isadmin']) {
                header("Location: home");
            } elseif ($page['fichier'] == "connect") {
                header("Location: account");
            }
        }
        else {
            if($page['categorie']!="home" and $page['categorie']!="account") {
                //verifier si user est nouveau et le forcer a remplir ses infos
                header("Location: account-first-access");
            }
        }
    }
    else{
        header ("Location: home");
    }
}
//verification des pages bloquantes, si user est pas connecter et veut acceder a des pages avec acces
else{
    if($page['categorie']!="home" and $page['categorie']!="menu"){
        header ("Location: connect");
    }
}
//-------------fin verification acces------------------------------------------------------

?>

    <nav class="<?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a'] ?>">
        <div class="nav-wrapper container <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a'] ?>">

            <?php
            if($page['fichier']=='home'){
                ?>
            <a href="#" class="brand-logo left boite-bouf button-collapse"  data-activates="slide-out">
                <h3 style="margin-top:8px;text-shadow: 1px -1px #DDDDDD;font-weight: 600;"><?php echo $page["titre"]; ?></h3>
            </a>
            <?php
            }

            if($page['pageretour']=='previous') {
                ?>
                <a href="javascript:history.back()" class="left"><i class="material-icons">arrow_back</i></a>
                <?php
            }
            elseif($page['pageretour']!='none'){
                ?>
            <a href="<?php echo $page["pageretour"] ?>" class="left"><i class="material-icons">arrow_back</i></a>
            <?php
            }

            if(strcmp($page["fichier"],"home")!= 0){
                ?>
            <a class="brand-logo center"><?php echo $page["titre"] ?></a>
            <?php
            }
            ?>

            <ul id="nav-mobile" class="right">

                <?php
                if (strcmp($page["categorie"], "shop") == 0) {
                    ?>
                    <li><a href="shop-cart"><i class="material-icons">shopping_cart</i></a></li>
                    <?php
                }
                if($page['fichier']=="home") {
                    if (isset($_SESSION['user-isadmin'])) {
                        if ($_SESSION['user-isadmin'] == true) {
                            //si admin affiche bouton d'acces panel admin
                            ?>
                            <li><a href="admin"><i class="material-icons">developer_board</i></a></li>
                            <?php
                        }
                    }
                }
                if(strcmp($page["fichier"],"connect")!=0 ){
                    if(isset($_SESSION['user-online'])){
                        if($_SESSION['user-online']==true){
                            $btnCompte = "account";
                        }
                        else { $btnCompte = "#"; }
                    }
                    else { $btnCompte = "connect"; }

                echo "<li><a href=$btnCompte><i class=\"material-icons\">person</i></a></li>";
                }
                ?>

            </ul>
        </div>
    </nav>

    <?php
include_once($page["fichier"]."-content.php");
?>