<?php
$fichier = explode("/", $_SERVER['PHP_SELF']);
$fichier = $fichier[count($fichier)-1];

$sql = "SELECT * FROM w_pages_contenu WHERE CONCAT(fichier,'.php') LIKE '$fichier'";
$result = $mysqli->query($sql);
$page = $result->fetch_assoc();
?>

    <nav class="deep-orange accent-2">
        <div class="nav-wrapper deep-orange accent-2 container">

            <?php
            if($page['fichier']=='home'){
                ?>
            <a href="#" class="brand-logo left boite-bouf">
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
                if(strcmp($page["categorie"],"account")!=0){
                echo "<li><a href=\"account.php\"><i class=\"material-icons\">person</i></a></li>";
                }
                if(strcmp($page["categorie"],"shop")==0){
                    ?>
                <li><a href="shop-cart.php"><i class="material-icons">shopping_cart</i></a></li>
                <?php
                }
                ?>

            </ul>
        </div>
    </nav>

    <?php
include_once($page["fichier"]."-content.php");
?>