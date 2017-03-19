<?php
if(isset($_POST['textarea1'])){
    $textarea = $_POST['textarea1'];
    $sql = "UPDATE pages SET textarea = ? WHERE nom LIKE 'termes';";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $textarea);
    $stmt->execute();
    $stmt->close();
}
$stmt = $mysqli->prepare("SELECT textarea, nom FROM pages WHERE categorie LIKE 'termesetconditions';");
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
        height: 200,
    });
</script>

<div class="container">
    <form action="#" class="section" method="post">
        <h5>Termes et conditions du site</h5>
        <textarea id="textarea1" name="textarea1"><?php if($i = array_search("termes",$titre,true)){ echo $tarea[$i];}; ?></textarea>
        <br/>
        <button type="submit" style="width: 100%" class="btn btn-large <?php echo $_GLOBAL['couleur1a']?> ">Enregister</button>
    </form>
</div>