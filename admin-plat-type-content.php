<?php if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'plat-type-mod'){?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Type de plat modifié', 3000);
            });
        </script>
    <?php }elseif($_SESSION['toast'] == 'plat-type-add'){ ?>
            <script type="text/javascript">
                    $(document).ready(function () {
                    Materialize.toast('Type de plat ajouté', 3000);
                    });
            </script>
    <?php }elseif($_SESSION['toast'] == 'erreur-plat-type'){ ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('La modification a échoué', 3000);
            });
        </script>
    <?php }
    unset($_SESSION['toast']);
}
$stmt = $mysqli->prepare("SELECT id,type,ordre FROM p_item order by ordre;");
$stmt->execute();
$stmt->bind_result($id,$type,$ordre);
$arrayId = array();
$arrayType = array();
$arrayOrdre = array();
$arrayId[0] = 0;
$arrayType[0] = "";
$arrayOrdre[0] = "";
while($stmt->fetch()) {
    $arrayId[] = $id;
    $arrayType[] = ucfirst(strtolower($type));
    $arrayOrdre[] = $ordre;
}
$stmt->close();
?>
<div class="container">
    <div class="section">
        <form action="admin-plat-type-validation" method="POST">
            <div class="input-field">
                <i class="material-icons prefix">restaurant_menu</i>
                <select name="id" id="id" required>
                    <option value="0" selected>-- Insérer un nouveau type de plat --</option>
                    <?php
                    for($i=1; $i<sizeof($arrayId); $i++){
                        echo "<option value=\"$arrayId[$i]\">Modifier: ". ucfirst(strtolower($arrayType[$i])) ." (#$arrayOrdre[$i])</option>";
                    }
                    ?>
                </select>
                <label>Type de plat</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">title</i>
                <input type="text" id="type" name="type" class="validate" required>
                <label>Nom du type de plat</label>
            </div>
            <div class="input-field">
                <i class="material-icons prefix">format_list_numbered</i>
                <input type="number" id="ordre" name="ordre" class="validate" min="0" max="20" required>
                <label>Ordre de tri</label>
            </div>
            <button style="width: 100%;" class="waves-effect waves-light btn-large <?php echo $_GLOBAL['couleur1a'] ?> "
                        type='submit' name="modtype">Enregistrer</button>
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    arrayId = <?php echo json_encode($arrayId); ?>;
    arrayType = <?php echo json_encode($arrayType); ?>;
    arrayOrdre = <?php echo json_encode($arrayOrdre); ?>;
    $('select').material_select();
    $('#id').change(function(){
        type    = $('#type');
        ordre   = $('#ordre');
        value   = $(this).val();
        found = jQuery.inArray(parseInt(value), arrayId);
        type.val(arrayType[found]);
        ordre.val(arrayOrdre[found]);
        if(found!=0) {
            ordre.focusin();
            type.focusin();
        }
        else{
            ordre.focusout();
            type.focusout();
        }
    });
});
</script>