<div class="slider">
    <ul class="slides">
        <li>
            <img src="http://static.harmony.groupetva.ca/media/static/filemanager/content/1444104000/poulet-general-tao_1444157247.jpg"> <!-- random image -->
            <div class="caption center-align">
                <h3>Poulet</h3>
                <h5 class="light grey-text text-lighten-3">Poulet General Tao</h5>
            </div>
        </li>
        <li>
            <img src="http://nomadjunkies.com/wp-content/uploads/2017/01/Photo-01_Fotor-1900x700_c.jpg"> <!-- random image -->
            <div class="caption left-align">
                <h3>Semaine 2</h3>
                <h5 class="light grey-text text-lighten-3">Poutine cambogienne</h5>
            </div>
        </li>
        <li>
            <img src="http://maigrirsansfaim.net/wp-content/uploads/2015/03/patechinoischeval.png"> <!-- random image -->
            <div class="caption right-align">
                <h3>Menu semaine 3</h3>
                <h5 class="light grey-text text-lighten-3">Pate chinois</h5>
            </div>
        </li>
        <li>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/Cuisse_da_canard_confit_et_pommes_de_terre_%C3%A0_la_sarladaise.JPG/1200px-Cuisse_da_canard_confit_et_pommes_de_terre_%C3%A0_la_sarladaise.JPG"> <!-- random image -->
            <div class="caption center-align">
                <h3>Canard</h3>
                <h5 class="light grey-text text-lighten-3">Confit aux patates douces et fromage</h5>
            </div>
        </li>
    </ul>
</div>
<br />

<div class='container'>
    <div class="s12">
        <a style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?>" href='menu'>
            <?php if(!isset($_SESSION['user-online'])){ echo "Menu de la semaine"; } else { echo "Commander"; } ?>
        </a>
    </div>
</div>
<br/>

<ul id="slide-out" class="side-nav">
    <li>
        <div class="center userView">
            <img src="css/ico/logo_blanc.png" width="70%"">
        </div>
    </li>
    <li><div class="divider"></div></li>
    <li><a href="#!"><i class="material-icons">map</i>Menu de la semaine</a></li>
    <li><a href="#!"><i class="material-icons">today</i>Horaires</a></li>
    <li><a href="#!"><i class="material-icons">perm_phone_msg</i>Nous contacter</a></li>
    <li><a href="#!"><i class="material-icons">help</i>Fonctionnement</a></li>
    <li><a href="#!"><i class="material-icons">store</i>A propos de l'entreprise</a></li>
    <li><a href="#!"><i class="material-icons">gavel</i>Termes et conditions</a></li>
</ul>

<script type="text/javascript">
$(document).ready(function(){
    $('.slider').slider({
        height:350,
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