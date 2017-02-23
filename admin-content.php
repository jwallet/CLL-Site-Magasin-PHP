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
        <li><a class="collection-item center-align" href="admin-majclient.php"><i class="small material-icons">person</i>Mise à jour client</a></li>
        <li><a class="collection-item center-align" href="admin-majclient.php"><i class="small material-icons">shopping_basket</i>Commandes Clients</a></li>
        <li><a class="collection-item center-align" href="admin-majclient.php"><i class="small material-icons">restaurant</i>Menu de la semaine</a></li>
        <li><a class="collection-item center-align" href="admin-majclient.php"><i class="small material-icons">restaurant_menu</i>Formulaire des commandes</a></li>
    </div>
</ul>
<a href="#" data-activates="slide-out" class="button-collapse show-on-small"><i class="material-icons">menu</i></a>
<!--<div class="collection">-->
<!--    <a class="collection-item center-align" href="admin-majclient.php"><i class="medium material-icons">person</i>Mise à jour client</a>-->
<!--    <a class="collection-item center-align" href="admin-majclient.php"><i class="medium material-icons">shopping_basket</i>Commandes Clients</a>-->
<!--    <a class="collection-item center-align" href="admin-majclient.php"><i class="medium material-icons">restaurant</i>Menu de la semaine</a>-->
<!--    <a class="collection-item center-align" href="admin-majclient.php"><i class="medium material-icons">restaurant_menu</i>Formulaire des commandes</a>-->
<!--</div>-->
<?php

$DayOfWeek = date('N') - 1;
$WeekStart = new DateTime(date('Y-m-d'));
$WeekStart->sub(new DateInterval('P' . $DayOfWeek . 'D'));
$WeekEnd = new DateTime($WeekStart->format('Y-m-d'));
$WeekEnd->add(new DateInterval('P6D'));
$WeekStart=$WeekStart->format('Y-m-d');
$WeekEnd = $WeekEnd->format('Y-m-d');
$query = "SELECT * FROM Menu WHERE datemenud between $WeekStart and $WeekEnd;";
$result = $mysqli->query($query);
echo "<TABLE border=1>";
while ($val = mysqli_fetch_array($result, MYSQLI_BOTH)){	//utilisation de mysqli_fetch_array($result2, MYSQLI_BOTH) ou , MYSQLI_NUM ou , MYSQLI_ASSOC

    echo "<TR>"."<TD>".$val["idmenu"]."<TD>".$val[1]."<TD>"."<IMG SRC=".$val["description"]."></TR>";

}
echo "</TABLE>";
?>
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>