<?php
$stmt = $mysqli->prepare("SELECT textarea FROM pages WHERE categorie LIKE 'faq';");
$stmt->execute();
$stmt->bind_result($tarea);
$stmt->fetch();

$divider = explode("###", $tarea);

$stmt->free_result();
$stmt->close();

$questions = array();
$reponses = array();

for($i=1;$i<sizeof($divider);$i+=2){
    $questions[] = $divider[$i];
    $reponses[] = $divider[$i+1];
}

?>
<ul class="collapsible" data-collapsible="accordion">
    <?php for($j=0;$j<sizeof($questions);$j++){ ?>
    <li>
            <div class="collapsible-header">
                <div class="container"><?php echo $questions[$j]; ?></div>
            </div>
            <div class="collapsible-body grey lighten-3">
                <div class="container">
                    <span><?php echo $reponses[$j]; ?></span>
                </div>
            </div>
    </li>
    <?php } ?>
</ul>

<script type="text/javascript">
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });
</script>