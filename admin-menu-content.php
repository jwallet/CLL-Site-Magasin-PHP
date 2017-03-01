<?php
if(isset($_GET['next'])){
    $visnext=1;
    $visnow =0;
    $action="next";
}
elseif(isset($_GET['current'])){
    $visnext=0;
    $visnow =1;
    $action="current";
}
else{
    header ("Location: admin");
}
$stmt = $mysqli->prepare("SELECT id, titre FROM menu WHERE isnext = ? AND isnow = ?;");
$stmt->bind_param("ii",$visnext,$visnow);
$stmt->execute();
$stmt->bind_result($id, $titre);
$stmt->fetch();
?>
    <div class="container">
    <div class="section">
        <form class="row" action="admin-menu-validation" method="GET">
            <div class="col s12">
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                <div class="input-field row">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="titre" id="titre" class="validate" value="<?php echo $titre; ?>" required>
                    <label for="titre">Titre du menu</label>
                </div>
                <div class="row">
                    <?php
                    $menuloaded = $id;
                    $stmt->free_result();
                    if($menuloaded>0){
                        $sql="SELECT i.id, t.type, i.titre, i.prix, m.idmenu FROM item i JOIN p_item t ON i.idtype=t.id LEFT JOIN menu_detail m ON i.id = m.iditem WHERE m.idmenu = ? OR m.idmenu IS NULL ORDER BY t.ordre;";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param('i',$menuloaded);
                        $stmt->execute();
                        $stmt->bind_result($iditem,$type,$item,$prix,$idmenu);
                    }
                    else{
                        $sql = "SELECT i.id, t.type, i.titre, i.prix FROM item i JOIN p_item t ON i.idtype=t.id ORDER BY t.ordre;";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute();
                        $stmt->bind_result($iditem,$type,$item,$prix);
                        $idmenu=null;
                    }
                    $group = null;
                    while($stmt->fetch()) {
                        $type = ucfirst(strtolower($type));
                        if($idmenu!=null){ $checkit="checked"; } else { $checkit = ""; }
                        if(strcmp($group,$type)==0){
                            echo "
                            <tr>
                                <td><input type=\"checkbox\" id=\"$iditem\" value=\"$iditem\" name=\"items\" $checkit/>
                                    <label for=\"$iditem\">$item</label></td>
                                <td class=\"right-align\">$prix $</td>
                            </tr>
                            ";
                        }
                        else{
                            if($group!=null){
                                echo " </tbody>
                                        </table>
                                        <br/>";
                            }
                            echo "<table class=\"striped\">
                            <thead>
                            <tr>
                                <th data-field=\"type\">$type</th>
                                <th class=\"right-align\" data-field=\"prix\">Prix</th>
                            </tr>
                            </thead>
    
                            <tbody>
                            <tr>
                                <td><input type=\"checkbox\" id=\"$iditem\" value=\"$iditem\" name=\"items\" $checkit/>
                                    <label for=\"$iditem\">$item</label></td>
                                <td class=\"right-align\">$prix $</td>     
                            </tr>";
                        }
                        $group = $type;
                    }
                    echo "</tbody>
                            </table>
                            <br/>";
                    $stmt->close();
                    ?>
                </div>
                <div class="row">
                    <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1'] . $_GLOBAL['couleur1a']?> "
                            type='submit' name="save">Enregistrer le menu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
        $('plat-type').on('click', function(event) {
            event.stopPropagation();
        });
    });
</script>

<?php
//
//$DayOfWeek = date('N') - 1;
//$WeekStart = new DateTime(date('Y-m-d'));
//$WeekStart->sub(new DateInterval('P' . $DayOfWeek . 'D'));
//$WeekEnd = new DateTime($WeekStart->format('Y-m-d'));
//$WeekEnd->add(new DateInterval('P6D'));
//$WeekStart=$WeekStart->format('Y-m-d');
//$WeekEnd = $WeekEnd->format('Y-m-d');
//
//
//$query = "SELECT n.nomrepas,n.description,n.prixportion FROM menu m,relmenunourr rmn,nourriture n WHERE datemenud between '$WeekStart' and '$WeekEnd' and rmn.idmenu = m.idmenu and n.idrepas = rmn.idrepas;";
//$result = $mysqli->query($query) or die("Error: ".mysqli_error($mysqli));
//if (!$result) {
//    printf("Error: %s\n", mysqli_error($mysqli));
//    exit();
//}
//echo " <h3 class=\"center\">Menu de la semaine</h3>";
//echo "<ul class=\"collection\">";
//while ($val = $result->fetch_assoc()){
//    echo "<li class=\"collection-item avatar\">
//    <img src=\"images/yuna.jpg\" alt=\"\" class=\"circle\">
//    <div class=\"card-panel hoverable\">
//    <span class=\"title \">". $val['nomrepas'] ."</span>
//    <p> Description: " . $val['description'] . "<br>
//        Prix par portion: ". $val['prixportion']."$
//    </p>
//    </div>
//    <div class='secondary-content'>
//        <a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons medium\">edit</i></a>
//        <a href=\"#!\" class=\"secondary-content\"><i class=\"material-icons medium\">edit</i></a>
//    </div>
//    </li>";
//}
//echo "</ul>";
//?>