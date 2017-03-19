<?php
/**
 * Created by PhpStorm.
 * User: w1z1k
 * Date: 3/14/2017
 * Time: 12:06 PM
 */

if(isset($_POST['textarea1'])){
    $textarea = $_POST['textarea1'];
    $sql = "UPDATE pages SET textarea = ? WHERE nom LIKE 'fonctionnement';";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $textarea);
    $stmt->execute();
    $stmt->close();
}
$stmt = $mysqli->prepare("SELECT textarea, nom FROM pages WHERE categorie LIKE 'faq';");
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
        selector: '#textarea1',
        theme: 'modern',
        language: 'fr_FR',
        menubar:false,
        statusbar: false,
        toolbar: 'undo redo | styleselect | bold italic underline | blockquote | alignleft aligncenter alignright alignjustify | link | outdent indent | removeformat | code',
        plugins: 'code link',
        height: 400
    });
</script>

<div id="tool" class="container">
    <form action="#" class="section" method="post">
        <h5>Fonctionnement (FAQ)</h5>
        <p>Utilisez ### pour ajouter une section, puis sur une nouvelle ligne écrivez le contenu de la nouvelle section.<br/><div style="background-color:#666; color:white; padding:10px;border:1px solid black;font-family: Courier"><b>###</b> Titre de la section <b>###</b><br/>Le contenu de la section</div></p>
        <textarea id="textarea1" name="textarea1"><?php if($i = array_search("fonctionnement",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <br/>
        <button type="submit" style="width: 100%" class="btn btn-large <?php echo $_GLOBAL['couleur1a']?> ">Enregistrer</button>
    </form>
</div>