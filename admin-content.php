<?php
$DayOfWeek = date('N') - 1;
$WeekStart = new DateTime(date('Y-m-d'));
$WeekStart->sub(new DateInterval('P' . $DayOfWeek . 'D'));
$WeekEnd = new DateTime($WeekStart->format('Y-m-d'));
$WeekEnd->add(new DateInterval('P6D'));
$WeekStart=$WeekStart->format('Y-m-d');
$WeekEnd = $WeekEnd->format('Y-m-d');



//ATTENTION AU SELECT SANS PREPARE STATEMENT, FACILE D'INJECTION SQL POUR DETRUIRE LA BD OU CREER USAGER ADMIN
//LA FACON DE GERER LES MENUS PAR LA DATE A ETE MODIFIEE, VOIR CHAT
//LE MENU ADMIN EN SLIDESHOW A ETE RETIRER VU QUE EN PLEIN ECRAN LES OPTIONS DANS NAVBAR DEBORDAIENT LARGEMENT
//LES MENUS SERONT PLUTOT PLACE SUR LA PAGE PRINCIPALE DE LADMIN EN LISTE EXPENDABLE
//LORSQUE CONNEXION SERA TERMINER UN VARIABLE SESSION SERA ACTIVE POUR DETERMINER LADMIN DUN USAGER

//$query = "SELECT  FROM menu m INNER JOIN relmenunourr  mn on m.idmenu = mn.idmenu INNER JOIN nourriture n on n.idrepas = mn.idrepas WHERE datemenud between '$WeekStart' and '$WeekEnd';";
$query = "SELECT n.nomrepas,n.description,n.prixportion FROM menu m,relmenunourr rmn,nourriture n WHERE datemenud between '$WeekStart' and '$WeekEnd' and rmn.idmenu = m.idmenu and n.idrepas = rmn.idrepas;";
//$query = "UPDATE menu SET description='bonjour' WHERE idmenu='1';";
$result = $mysqli->query($query) or die("Error: ".mysqli_error($mysqli));
if (!$result) {
    printf("Error: %s\n", mysqli_error($mysqli));
    exit();
}
echo " <h3 class=\"center\">Menu de la semaine</h3>";
echo "<ul class=\"collection\">";
while ($val = $result->fetch_assoc()){
//    echo "<li class=\"collection-item dismissable\"><div>" . $val['nomrepas'] ."<a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons\">send</i></a></div></li>";
    echo "<li class=\"collection-item avatar\">
            <img src=\"images/yuna.jpg\" alt=\"\" class=\"circle\">
            <div class=\"card-panel hoverable\">
                <span class=\"title \">". $val['nomrepas'] ."</span>
                <p> Description: " . $val['description'] . "<br>
                    Prix par portion: ". $val['prixportion']."$
                </p>
            </div>
            <div class='secondary-content'>
             <a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons medium\">edit</i></a>
             <a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons medium\">edit</i></a>
             </div>
        </li>";
//    echo "<br><h4> " . "id:  " . $val['idmenu'] . "</br>";
//    echo "<h4>" . "desc:  " . $val['description'] ;
}
echo "</ul>";
//$val = mysqli_fetch_array($result);
//$description = $val["description"];
//echo $description;

?>

