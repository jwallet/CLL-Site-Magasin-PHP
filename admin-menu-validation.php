<?php
if(isset($_POST['titre'])) {
    include("bd-connect.php");
    $action = $_POST['action'];
    if(isset($_POST['items'])) {
        $items = $_POST['items'];
        $count = sizeof($items);
    }
    else{
        $count = 0;
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
            $stmt->bind_result($menu);
            $stmt->fetch();
            $idmenu = $menu;
            echo "--insert-menu-next--";
            $_SESSION['toast']="menu-next-added";
        }
        else{
            $sql="UPDATE menu SET titre = ? WHERE isnext = 1 AND id = ?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si",$_POST['titre'],$_POST['id']);
            $stmt->execute();
            $stmt->free_result();
            $idmenu = (int)$_POST['id'];
            echo "--update-menu-next--";
        }
        $_SESSION['toast']="menu-next-updated";
    }
    else{
        $idmenu = (int)$_POST['id'];
        echo "NOW!!!";
        $sql="UPDATE menu SET titre = ? WHERE isnow = 1 AND id = ?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si",$_POST['titre'],$idmenu);
        $stmt->execute();
        echo "--update-menu-now--";
        $_SESSION['toast']="menu-now-updated";
    }
    //verifier combien enregistrement sont deja dispo dans la bd pour se faire overwriter par le next loop
    $sql="SELECT id FROM menu_detail WHERE idmenu = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i",$idmenu);
    $stmt->execute();
    $stmt->bind_result($id);
    $j = 0;
    $itemsdejabd = array();
    while($stmt->fetch()) {
        $itemsdejabd[] = $id;
    }
    $stmt->free_result();
    //echo "--items-count-FOUND!--";
    for($j = 0; $j < sizeof($itemsdejabd); $j++){
        $iditem = (int)$itemsdejabd[$j];
        if($j<$count){
            $sql="UPDATE menu_detail SET iditem = ? WHERE idmenu = ? AND id = ?;";//yer passent toutes parce que y check pas de id de item
            $stmt = $mysqli->prepare($sql);
            $itemvalue = (int)$items[$j];
            $stmt->bind_param("iii",$itemvalue,$idmenu,$iditem);
            $stmt->execute();
        }
        else{
            $sql = "DELETE FROM menu_detail WHERE id = ?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i",$iditem);
            $stmt->execute();
            //echo "--deleted-old-entry--";
        }
        $stmt->free_result();
        //echo "--update-items--".$j;
    }
    if($j<$count) {
        for ($i = $j; $i < $count; $i++) {
            $sql = "INSERT INTO menu_detail (idmenu, iditem) VALUES (?,?);";
            $stmt = $mysqli->prepare($sql);
            $itemvalue = (int)$items[$i];
            $stmt->bind_param("ii", $idmenu, $itemvalue);
            $stmt->execute();
            $stmt->free_result();
            //echo "--insert-items--" . $i;
        }
    }
    $stmt->close();
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL=admin"; } ?>
</head>
</html>