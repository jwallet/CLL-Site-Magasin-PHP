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
<!--Affichage de l'interface du menu -->
    <div class="container">
    <div class="section">
        <form action="admin-menu-validation" method="POST" style="margin-top:20px;margin-bottom:20px;">
            <input type="hidden" name="action" value="<?php echo $action; ?>"/>
            <input type="hidden" name="id" value="<?php echo $menuloaded; ?>"/>
            <div class="input-field">
                <i class="material-icons prefix">title</i>
                <input type="text" name="titre" id="titre" class="validate" value="<?php echo $titre; ?>" required>
                <label for="titre">Titre du menu</label>
            </div>
            <div>
                <?php
                $stmt->free_result();
                $idmenu = null;
                $sql = "SELECT idmenu, iditem FROM menu_detail WHERE idmenu = ?;";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param('i',$menuloaded);
                $stmt->execute();
                $stmt->bind_result($idmenu,$iditem);
                $itemsIdFromMenu = array();
                while($stmt->fetch()) {
                    $itemsIdFromMenu[] = $iditem;
                }
                $sql = "SELECT i.id, t.type, i.titre, i.prix FROM item i JOIN p_item t ON i.idtype=t.id WHERE i.desactif=0 ORDER BY t.ordre;";
                $stmt = $mysqli->prepare($sql);
                $stmt->execute();
                $stmt->bind_result($iditem,$type,$item,$prix);
                $group = null;
                while($stmt->fetch()) {
                    $type = ucfirst(strtolower($type));
                    if(in_array($iditem,$itemsIdFromMenu)){ $checkit="checked"; } else { $checkit = ""; }
                    if(strcmp($group,$type)==0){
                        echo "
                        <tr>
                            <td><input type=\"checkbox\" id=\"$iditem\" value=\"$iditem\" name=\"items[]\" $checkit/>
                                <label for=\"$iditem\">$item</label></td>
                            <td class=\"right-align\">" . money_format('%(#10n', $prix) . "</td>
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
                            <td class=\"right-align\">" . money_format('%(#10n', $prix) . "</td>     
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
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] . " " . $_GLOBAL['couleur1b']?> "
                    type='submit' name="save">Enregistrer le menu</button>
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