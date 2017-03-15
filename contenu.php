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
            elseif ($page['fichier'] == "account-first-access") {
                header("Location: home");
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
    if(($page['categorie']!="home" and $page['categorie']!="menu") or $page['fichier']=="account-first-access"){
        header ("Location: connect");
    }
}
//-------------fin verification acces------------------------------------------------------

?>
<div class="progress" id="mainProgressBar" style="margin:0;">
    <div class="indeterminate"></div>
</div>

    <nav class="<?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b'] ?>" style="background-image:url('css/res/wood.jpg');background-size:auto 62px;border-bottom:2px solid #4e342e;text-shadow: #444 0px -2px;">
        <div class="nav-wrapper container" style="background:none;background-color: transparent;">
            <ul class="left">
            <?php
            if($page['fichier']=='home'){
                ?>
            <li><a href="#" class="left button-collapse"  data-activates="slide-out">
               <i class="material-icons" style="font-size: 35px;">menu</i>
            </a></li>
            <?php
            }

            if($page['pageretour']=='previous') {
                ?>
                <li><a href="javascript:history.back()" class="left"><i class="material-icons">arrow_back</i></a></li>
                <?php
            }
            elseif($page['pageretour']!='none'){
                ?>
                <li><a href="<?php echo $page["pageretour"] ?>" class="left"><i class="material-icons">arrow_back</i></a></li>
            <?php
            }

            if(strcmp($page["fichier"],"home")!= 0){
                ?>
                <li><a class="brand-logo center"><?php echo $page["titre"] ?></a></li>
            <?php
            }
            ?>
            </ul>
            <ul class="right">

                <?php
                if (isset($_SESSION['user-online']) AND isset($_SESSION['user-isadmin'])) {
                    if(!$_SESSION['user-isadmin']) {
                        ?>
                        <li><a href="shop-cart"><i class="material-icons">shopping_cart</i></a></li>
                        <?php
                    }
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

<script type="text/javascript">
    window.onload = function () {
        $("#mainProgressBar").addClass('hide');
    }
</script>
