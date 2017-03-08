<?php
if(isset($_POST['type']) and isset($_POST['id']) and isset($_POST['ordre'])) {
    include("bd-connect.php");
    $type = $_POST['type'];
    $id = $_POST['id'];
    $ordre = $_POST['ordre'];
    echo $type . " ".$id . " ". $ordre;
    if ($id != 0) {
        $sql = "UPDATE p_item SET type=?, ordre=? WHERE id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sii", $type, $ordre, $id);
        if ($stmt->execute()) {
            $_SESSION['toast'] = "plat-type-mod";
            $redirect = "admin-plat-type";
        }
        $stmt->free_result();
        $stmt->close();
    } else {
        $sql = "INSERT INTO p_item (type,ordre) values (?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $type, $ordre);
        if ($stmt->execute()) {
            $_SESSION['toast'] = "plat-type-add";
            $redirect = "admin-plat-type";
        }
        $stmt->free_result();
        $stmt->close();
    }
}
else{
    $redirect = "admin-plat-type";
    $_SESSION['toast'] = "erreur-plat-type";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
