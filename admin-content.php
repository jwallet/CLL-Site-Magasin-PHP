<ul id="slide-out" class="side-nav">
    <li><div class="userView">
            <div class="background">
                <img src="images/office.jpg">
            </div>
            <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
            <a href="#!name"><span class="white-text name">John Doe</span></a>
            <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
        </div></li>
    <div class="collection">
        <li><a class="collection-item" href="admin-majclient.php"><i class="small material-icons right">person</i>Mise à jour client</a></li>
        <li><a class="collection-item" href="admin-majclient.php"><i class="small material-icons right">shopping_basket</i>Commandes Clients</a></li>
        <li><a class="collection-item" href="admin-majclient.php"><i class="small material-icons right">restaurant</i>Menu de la semaine</a></li>
        <li><a class="collection-item" href="admin-majclient.php"><i class="small material-icons right">restaurant_menu</i>Formulaire des commandes</a></li>
    </div>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse show-on-small"><i class="material-icons large">menu</i></a>
<?php
$DayOfWeek = date('N') - 1;
$WeekStart = new DateTime(date('Y-m-d'));
$WeekStart->sub(new DateInterval('P' . $DayOfWeek . 'D'));
$WeekEnd = new DateTime($WeekStart->format('Y-m-d'));
$WeekEnd->add(new DateInterval('P6D'));
$WeekStart=$WeekStart->format('Y-m-d');
$WeekEnd = $WeekEnd->format('Y-m-d');
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
             <a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons medium\">edit</i></a>
        </li>";
//    echo "<br><h4> " . "id:  " . $val['idmenu'] . "</br>";
//    echo "<h4>" . "desc:  " . $val['description'] ;
}
echo "</ul>";
//$val = mysqli_fetch_array($result);
//$description = $val["description"];
//echo $description;
?>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>