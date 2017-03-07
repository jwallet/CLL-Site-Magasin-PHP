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
    <div class="section">
        <div class="col s12">
            <a style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?>" href='menu'>
                Menu de la semaine
            </a>
        </div>
    </div>
</div>

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