<?php
if(isset($_POST['plat-atype']) and isset($_POST['plat-ntype'])) {
    include("bd-connect.php");
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
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
