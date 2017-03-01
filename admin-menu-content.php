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
$menuloaded=0;
if($stmt->fetch()){
    $menuloaded = $id;
}
?>
    <div class="container">
    <div class="section">
        <form class="row" action="admin-menu-validation" method="POST">
            <div class="col s12">
                <input type="hidden" name="action" value="<?php echo $action; ?>"/>
                <input type="hidden" name="id" value="<?php echo $menuloaded; ?>"/>
                <div class="input-field row">
                    <i class="material-icons prefix">title</i>
                    <input type="text" name="titre" id="titre" class="validate" value="<?php echo $titre; ?>" required>
                    <label for="titre">Titre du menu</label>
                </div>
                <div class="row">
                    <?php
                    $stmt->free_result();
                    if($menuloaded!=0){
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
                                <td><input type=\"checkbox\" id=\"$iditem\" value=\"$iditem\" name=\"items[]\" $checkit/>
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
                                <td><input type=\"checkbox\" id=\"$iditem\" value=\"$iditem\" name=\"items[]\" $checkit/>
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