<?php
if(isset($_POST['textarea1']) or isset($_POST['textarea2']) or isset ($_POST['textarea3'])){
    if(isset($_POST['textarea1'])) { $apropos = true; }
    if(isset($_POST['textarea2'])) { $horaire = true; }
    if(isset($_POST['textarea3'])) { $rejoindre = true; }
    while($apropos or $horaire or $rejoindre) {
        if($apropos){
            $apropos=false;
            $nom = "apropos";
            $textarea = $_POST['textarea1'];
        }
        elseif($horaire){
            $horaire = false;
            $nom = "horaire";
            $textarea = $_POST['textarea2'];
        }
        elseif($rejoindre){
            $rejoindre = false;
            $nom = "rejoindre";
            $textarea = $_POST['textarea3'];
        }
        $sql = "UPDATE pages SET textarea = ? WHERE nom LIKE ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $textarea, $nom);
        $stmt->execute();
        $stmt->close();
    }
}
$stmt = $mysqli->prepare("SELECT textarea, nom FROM pages WHERE categorie LIKE 'entreprise';");
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
$i=0;
$stmt->free_result();
$stmt->close();
?>

<script src='js/tinymce/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#textarea1, #textarea2, #textarea3',
        theme: 'modern',
        language: 'fr_FR',
        menubar:false,
        statusbar: false,
        content_css: 'css/materialize.css',
        body_class: 'tinybody',
        toolbar: 'undo redo | styleselect | bold italic underline | blockquote | alignleft aligncenter alignright alignjustify | outdent indent | removeformat |  code',
        plugins: 'code',
        height: 200,
       });
</script>

<div class="container">
    <form action="#" class="section" method="post">
        <h5>A propos de la Boîte à Bouf</h5>
        <textarea id="textarea1" name="textarea1"><?php if($i = array_search("apropos",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <h5>Nos horaires</h5>
        <textarea id="textarea2" name="textarea2"><?php if($i = array_search("horaire",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <h5>Nous rejoindre</h5>
        <textarea id="textarea3" name="textarea3"><?php if($i = array_search("rejoindre",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <br/>
        <button type="submit" style="width: 100%" class="btn btn-large <?php echo $_GLOBAL['couleur1a']?> ">Enregister</button>
    </form>
</div>