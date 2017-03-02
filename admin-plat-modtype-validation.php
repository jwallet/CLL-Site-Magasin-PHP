<?php
include("bd-connect.php");
if(isset($_POST['modtype']) and isset($_POST['plat-ntype']) and isset($_POST['plat-atype']))
{
        $platatype = $_POST['plat-atype'];
        $platntype = $_POST['plat-ntype'];
        $sql = "UPDATE p_item SET type=? WHERE id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $platntype,$platatype);
        if ($stmt->execute()) {
            $_SESSION['toast'] = "plat-type-mod";
            $redirect = "admin-plat-modtype";
        }
        $stmt->free_result();
        $stmt->close();
}elseif(isset($_POST['plat-addtype']) and isset($_POST['plat-addtype']))
{
    $plataddtype = $_POST['plat-addtype'];
    $sql = "SELECT MAX(ordre) FROM p_item";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($idordre);
    if($stmt->fetch())
    {
        $idordre = $idordre + 1;
    }
    $stmt->free_result();
    $stmt->close();
    $sql = "INSERT INTO p_item (type,ordre) values (?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si", $plataddtype,$idordre);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "plat-type-add";
        $redirect = "admin-plat-modtype";
    }
    $stmt->free_result();
    $stmt->close();
}
?>
<html>
<head>
<!--    <meta http-equiv="refresh" content="0;URL='--><?php //echo $redirect; ?><!--'"/>-->
</head>
</html>
