<?php
if(isset($_POST['titre'])) {
    include("bd-connect.php");
    $action = $_POST['action'];
    if(isset($_POST['items'])) {
        $items = $_POST['items'];
        $count = sizeof($items);
    }
    if($action=="next"){
        if($_POST['id']==0){
            $n = 1;
            $c = 0;
            $sql="INSERT INTO menu (titre, isnow, isnext) VALUES (?,?,?);";
            $stmt->bind_param("sii", $_POST['titre'], $c, $n);
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $stmt->free_result();
            $sql ="SELECT id FROM menu WHERE isnext=1";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id);
        }
        else{
            $sql="UPDATE menu SET titre = ? WHERE isnext = 1 AND id = ?;";
            $stmt->bind_param("si",$_POST['titre'],$_POST['id']);
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $id = $_POST['id'];
        }
    }
    else{
        $sql ="SELECT id FROM menu WHERE isnow=1";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($id);
    }
    for ($i = 0; $i < $count; $i++){
        $sql="UPDATE menu_detail SET iditem = ? WHERE idmenu = 1;";
        $stmt->bind_param("si",$_POST['titre'],$_POST['id']);
        $stmt = $mysqli->prepare($sql);
        if(!$stmt->execute()) {
            $sql = "INSERT INTO menu (titre, isnow, isnext) VALUES (?,?,?);";
            $stmt->bind_param("sii", $_POST['titre'], $c, $n);
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
        }
        $items[$i]
    }
    //    $stmt->free_result();
    //    $stmt->close();
}
?>
<html>
<head>
<!--    <meta http-equiv="refresh" content="0;URL=admin"; } ?><!--'"/>-->
</head>
</html>