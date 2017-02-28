<?php
if(isset($_POST['plat-titre']) and isset($_POST['plat-prix'])and isset($_POST['plat-type'])) {
    include("bd-connect.php");
    $plattitre = $_POST['plat-titre'];
    $platdescription = $_POST['plat-description'];
    $platprix = $_POST['plat-prix'];
    $plattype = $_POST['plat-type'];
    $platimage = $_POST['plat-image'];
    echo $plattitre;echo $platdescription; echo $platprix;
    $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issds", $plattype, $plattitre, $platdescription, $platprix, $platimage);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "plat-ajout";
        $redirect = "admin";
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
