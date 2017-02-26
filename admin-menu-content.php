<?php

$DayOfWeek = date('N') - 1;
$WeekStart = new DateTime(date('Y-m-d'));
$WeekStart->sub(new DateInterval('P' . $DayOfWeek . 'D'));
$WeekEnd = new DateTime($WeekStart->format('Y-m-d'));
$WeekEnd->add(new DateInterval('P6D'));
$WeekStart=$WeekStart->format('Y-m-d');
$WeekEnd = $WeekEnd->format('Y-m-d');


$query = "SELECT n.nomrepas,n.description,n.prixportion FROM menu m,relmenunourr rmn,nourriture n WHERE datemenud between '$WeekStart' and '$WeekEnd' and rmn.idmenu = m.idmenu and n.idrepas = rmn.idrepas;";
$result = $mysqli->query($query) or die("Error: ".mysqli_error($mysqli));
if (!$result) {
printf("Error: %s\n", mysqli_error($mysqli));
exit();
}
echo " <h3 class=\"center\">Menu de la semaine</h3>";
echo "<ul class=\"collection\">";
    while ($val = $result->fetch_assoc()){
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
            }
            echo "</ul>";
?>