<div class="slider">
    <ul class="slides">
        <li>
            <img src="http://static.harmony.groupetva.ca/media/static/filemanager/content/1444104000/poulet-general-tao_1444157247.jpg"> <!-- random image -->
            <div class="caption center-align " style="width:100%;height:500px;left:0;top:0;background-color:rgba(0, 0, 0, 0.5);" >
                <img class="hide-on-small-only" src="css/ico/logo.png" style="width: auto; height:270px; margin-top:40px;"/>
                <img class="hide-on-med-and-up" src="css/ico/logo.png" style="width: auto; height: 230px; margin-top:60px;"/>
            </div>
        </li>
        <li>
            <img src="https://i.ytimg.com/vi/jyaLMHBKCic/maxresdefault.jpg"> <!-- random image -->
            <div class="caption center-align" style="width:100%;height:500px;left:0;top:0;background-color:rgba(0, 0, 0, 0.5);">
                <img class="hide-on-small-only" src="css/ico/logo.png" style="width: auto; height: 270px; margin-top:40px;"/>
                <img class="hide-on-med-and-up" src="css/ico/logo.png" style="width: auto; height: 230px; margin-top:60px;"/>
            </div>
        </li>
        <li>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/Cuisse_da_canard_confit_et_pommes_de_terre_%C3%A0_la_sarladaise.JPG/1200px-Cuisse_da_canard_confit_et_pommes_de_terre_%C3%A0_la_sarladaise.JPG"> <!-- random image -->
            <div class="caption center-align" style="width:100%;height:500px;left:0;top:0;background-color:rgba(0, 0, 0, 0.5);">
                <img class="hide-on-small-only" src="css/ico/logo.png" style="width: auto; height: 270px; margin-top:40px;"/>
                <img class="hide-on-med-and-up" src="css/ico/logo.png" style="width: auto; height: 230px; margin-top:60px;"/>
            </div>
        </li>
    </ul>
</div>

<div class='container'>
    <div class="section" style="width: 94%; margin-left:3%; margin-right: 3%;">
        <div class="center red-text text-darken-2" style="width: 100%;font-size:120%;font-weight: bold;line-height: 2.5;">
            <?php
            $dayend = $_GLOBAL['jour-limite-commander-text'];
            $daystart = $_GLOBAL['jour-debut-commander-text'];
            if(date("N")<=$_GLOBAL['jour-limite-commander']){
                echo "<span>Date limite : " . strftime("%A, %e %B",date(strtotime("next $dayend"))) . "</span>";
            }
            else{
                echo "<span>Date limite expirée<br/>Prochain menu : " . strftime("%A, %e %B",date(strtotime("next $daystart"))) . "</span>";
            }?>
        </div>
        <div>
            <a style="width:100%;" class="waves-effect waves-light btn-large <?php if(date("N")>$_GLOBAL['jour-limite-commander']){ echo "disabled";}?> <?php echo $_GLOBAL['couleur-menu-2a'] . ' ' .$_GLOBAL['couleur-menu-2b'] ?>" href='menu'>
                Menu de la semaine
            </a>
            <?php include_once("home-horaire-content.php");
                include_once("home-contact-content.php"); ?>
            <a style="width:100%;" class="waves-effect waves-light btn-large <?php if(date("N")>$_GLOBAL['jour-limite-commander']){ echo "disabled";}?> <?php echo $_GLOBAL['couleur1a'] ?>" href='home-faq'>
                Fonctionnement
            </a>
        </div>
    </div>
</div>

<ul id="slide-out" class="side-nav">
    <li>
        <div class="center userView">
            <a href="#"><img src="css/ico/logo_blanc.png" width="70%"></a>
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li><a href="menu"><i class="material-icons">map</i>Menu de la semaine</a></li>
    <?php if(isset($_SESSION['user-online'])){ if($_SESSION['user-online']){ echo "
    <li><a href=\"shop-cart\"><i class=\"material-icons\">shopping_cart</i>Panier de commande</a></li>
    <li><a href=\"account\"><i class=\"material-icons\">person</i>Compte</a></li>
    "; }}else{
        ?>
        <li><a href="connect"><i class="material-icons">input</i>Connexion</a></li>
    <?php
    }?>
    <li><div class="divider"></div></li>
    <li><a href="home-faq"><i class="material-icons">help</i>Fonctionnement</a></li>
    <li><a href="home-a-propos"><i class="material-icons">store</i><?php echo $_GLOBAL['entreprise'];?></a></li>
    <li><a href="home-termes-conditions"><i class="material-icons">gavel</i>Termes et conditions</a></li>
    <?php if(isset($_SESSION['user-online'])){ if($_SESSION['user-isadmin']){ echo "
    <li><div class=\"divider\"></div></li>
    <li><a href=\"admin\"><i class=\"material-icons\">developer_board</i>Administration</a></li>
    "; }}?>
</ul>

<script type="text/javascript">
$(document).ready(function(){
    $('.slider').slider({
        height:350,
        transition:2000,
        indicators:false,
        interval:6000
    });
    $('.button-collapse').sideNav({
        menuWidth: 300, // Default is 300
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });
});
</script>