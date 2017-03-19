<?php
if(isset($_POST['textarea1']) or isset ($_POST['textarea2'])){
    if(isset($_POST['textarea1'])) { $commander = true; }
    if(isset($_POST['textarea2'])) { $cookie = true; }
    while($commander or $cookie) {
        if ($commander) {
            $commander = false;
            $nom = "commander";
            $textarea = $_POST['textarea1'];
        }
        elseif($cookie){
            $cookie = false;
            $nom = "cookie";
            $textarea = $_POST['textarea2'];
        }
        $sql = "UPDATE pages SET textarea = ? WHERE nom LIKE ? AND categorie LIKE 'confirmation';";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $textarea, $nom);
        $stmt->execute();
        $stmt->close();
    }
}
$stmt = $mysqli->prepare("SELECT textarea, nom FROM pages WHERE categorie LIKE 'confirmation';");
$stmt->execute();
$stmt->bind_result($showtextarea, $shownom);
$titre = array();
$tarea = array();
$titre[] = $shownom;
$tarea[] = $showtextarea;
while($stmt->fetch()){
    $titre[] = $shownom;
    $tarea[] = $showtextarea;
}
$stmt->free_result();
$stmt->close();
?>
<script src='js/tinymce/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#textarea1, #textarea2',
        theme: 'modern',
        language: 'fr_FR',
        menubar:false,
        statusbar: false,
        toolbar: 'undo redo | styleselect | bold italic underline | blockquote | alignleft aligncenter alignright alignjustify | link | outdent indent | removeformat | code',
        plugins: 'code link',
        height: 200
    });
</script>

<div class="container">
    <form action="#" class="section" method="post">
        <h5>Termes et conditions avant de commander</h5>
        <textarea id="textarea1" name="textarea1"><?php if($i = array_search("commander",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <h5>Utilisation des cookies lors du premier accès</h5>
        <textarea id="textarea2" name="textarea2"><?php if($i = array_search("cookie",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <br/>
        <button type="submit" style="width: 100%" class="btn btn-large <?php echo $_GLOBAL['couleur1a']?> ">Enregister</button>
    </form>
</div>