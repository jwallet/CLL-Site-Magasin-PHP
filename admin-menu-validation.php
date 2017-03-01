<?php
if(isset($_POST['titre'])) {
    include("bd-connect.php");
    $action = $_POST['action'];
    if(isset($_POST['items'])) {
        $items = $_POST['items'];
        $count = sizeof($items);
    }
    if($action=="next"){
        echo "NEXT!!!";
        if($_POST['id']==0){
            $n = 1;
            $c = 0;
            $sql="INSERT INTO menu (titre, isnow, isnext) VALUES (?,?,?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sii", $_POST['titre'], $c, $n);
            $stmt->execute();
            $stmt->free_result();
            $sql ="SELECT id FROM menu WHERE isnext=1";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            echo "--insert-menu-next--";
        }
        else{
            $sql="UPDATE menu SET titre = ? WHERE isnext = 1 AND id = ?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si",$_POST['titre'],$_POST['id']);
            $stmt->execute();
            $stmt->free_result();
            $id = $_POST['id'];
            echo "--update-menu-next--";
        }
    }
    else{
        $sql ="SELECT id FROM menu WHERE isnow=1";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        echo "NOW!!!";
        $sql="UPDATE menu SET titre = ? WHERE isnow = 1 AND id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si",$_POST['titre'],$id);
        $stmt->execute();
        echo "--update-menu-now--";
    }
    //verifier combien enregistrement sont deja dispo dans la bd pour se faire overwriter par le next loop
    $sql="SELECT id FROM menu_detail WHERE idmenu = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $stmt->bind_result($idDb);
    $j = 0;
    while($stmt->fetch()){
        echo "--items-count-FOUND!--";
        $sql="UPDATE menu_detail SET iditem = ? WHERE idmenu = ? AND id = ?;";//yer passent toutes parce que y check pas de id de item
        $stmt2 = $mysqli->prepare($sql);
        $item = $items[$j];
        $stmt2->bind_param("iii",$item,$id, $idDb);
        $stmt2->execute();
        $stmt2->free_result();
        echo "--update-items--";
        $j++;
    }
    for ($i = $j; $i < $count; $i++){
        $sql = "INSERT INTO menu_detail (idmenu, iditem) VALUES (?,?);";
        $stmt2 = $mysqli->prepare($sql);
        $item = $items[$i];
        $stmt2->bind_param("ii",$item,$id);
        $stmt2->execute();
        $stmt2->free_result();
        echo "--insert-items--";
    }
    $stmt->free_result();
    $stmt->close();
}
?>
<html>
<head>
<!--    <meta http-equiv="refresh" content="0;URL=admin"; } ?><!--'"/>-->
</head>
</html>