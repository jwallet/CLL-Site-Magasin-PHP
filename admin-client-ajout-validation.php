<?php
include("bd-connect.php");
if(isset($_POST['plat-titre']) and isset($_POST['plat-prix'])and isset($_POST['plat-type'])) {


    $plattitre = $_POST['plat-titre'];
    $platdescription = $_POST['plat-description'];
    $platprix = $_POST['plat-prix'];
    $plattype = $_POST['plat-type'];
    $platimage = $_POST['plat-image'];
    $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssdis", $plattype, $plattitre, $platdescription, $platprix, $platimage);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "plat-ajout";
        $redirect = "admin";

    }
    $stmt->close();
//    else
//    {
//        $_SESSION['toast'] = "plat-ajout-erreur";
//        $redirect = "admin-plat-ajout";
//    }
//
//}
//else
//{
//    $_SESSION['toast'] = "plat-ajout-erreur";
//    $redirect = "admin-plat-ajout";
}

?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>