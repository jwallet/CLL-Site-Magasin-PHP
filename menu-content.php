<?php
//trouve les plats de la semaine selon l'ordre des categories
$itemsBdId = array();
$itemsBdType = array();
$itemsBdTitre = array();
$itemsBdPrix = array();
$sql="SELECT i.id, pi.type, i.titre, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre;";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($un,$deux,$trois, $quatre);
$j = 0;
while($stmt->fetch()) {
    $itemsBdId[] = (string)$un;
    $itemsBdType[] = $deux;
    $itemsBdTitre[] = $trois;
    $itemsBdPrix[] = $quatre;
}
$stmt->free_result();
$j = 0;
$htmltype = null;
echo "
<ul class=\"collapsible\" data-collapsible=\"expandable\">";
for($j = 0; $j<sizeof($itemsBdId); $j++){
    if(strcmp($htmltype,$itemsBdType[$j])!= 0){
    echo "      
    <li>
        <div class=\"collapsible-header active\">
            <div class=\"container\"><i class=\"material-icons\">restaurant_menu</i>";
echo ucfirst(strtolower($itemsBdType[$j]));
echo "
            </div>
        </div>
        <div class='collapsible-body' style='padding:0;'>
            <ul class=\"collapsible\" data-collapsible=\"expandable\">
";
    }
    $i = 0; //condition i pour permettre au premier de rentrer et de sinscrire
    while($j<sizeof($itemsBdId)&&(strcmp($htmltype,$itemsBdType[$j])== 0 || $i==0)) {
        echo "
                <li>
                    <div class=\"collapsible-header grey lighten-5\">
                        <div class=\"container\">";
        echo ucfirst(strtolower($itemsBdTitre[$j]));
        echo "<span class='secondary-content'>" . $itemsBdPrix[$j] . " $</span>";
        echo "
                        </div>
                    </div>
                    <div class='collapsible-body' style='padding:0;'>
                        <span>
                            <div class=\"container\">
                                item goes here
                            </div>
                        </span>
                    </div>
                </li>
";
        $htmltype = $itemsBdType[$j];
        $j++;
        $i = 1;
    }
    $i=0;
    if($j<sizeof($itemsBdId)) {
        if (strcmp($htmltype, $itemsBdType[$j]) != 0) {
                echo " 
                </ul>
            </div>
        </li>";
        }
    }
    else{
        echo " 
                </ul>
            </div>
        </li>";
    }
}
echo "
</ul>";
?>

<!--echo"-->
<!--<div class=\"product-card\">-->
<!--    <div class=\"product-image\">-->
<!--        <a href='menu-item'>-->
<!--            <img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class=\"product-info\">-->
<!--        <h5>Manteau</h5>-->
<!--        <h6>$99.99</h6>-->
<!--    </div>-->
<!--</div>-->
