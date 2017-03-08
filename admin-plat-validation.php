<?php
if(isset($_POST['titre']) and isset($_POST['prix'])and isset($_POST['type'])) {
    include("bd-connect.php");
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = "";
    }
    $platimage = "";
    $plattitre = $_POST['titre'];
    $platdescription = $_POST['description'];
    $platprix = $_POST['prix'];
    $plattype = $_POST['type'];
    $platimage = basename($_FILES['image']['name']); //retient le filename . extension
    $extension = pathinfo($platimage, PATHINFO_EXTENSION); // retient l extension seulement
    $filename = basename($_FILES['image']['name'], "." . $extension); // retient seulement le filename
    if(isset($_POST['image'])) {
        //si le fichier existe
        if (isset($_FILES["image"])) {
            $index = 0;
            while (@fopen($_GLOBAL['dirimg'] . $platimage, "r")) {
                $index = $index + 1;
                $platimage = $filename . $index . "." . $extension;
            }
            //copie du fichier du dossier temporaire au bon endroit
            copy($_FILES["image"]["tmp_name"], $_GLOBAL['dirimg'] . $platimage);
        }
    }
    if ($id != "") {
        if ($platimage != "") {
            $sql = "UPDATE item SET titre=?,description=?,prix=?,image=? WHERE id=?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssdsi", $plattitre, $platdescription, $platprix, $platimage, $id);
        } else {
            $sql = "UPDATE item SET titre=?,description=?,prix=? WHERE id=?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssdi", $plattitre, $platdescription, $platprix, $id);
        }
        $stmt->execute();
        $stmt->free_result();
        $stmt->close();
        $_SESSION['toast'] = "plat-mod";
        $redirect = "admin";

    } else {
        if ($platimage != "") {
            $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issds", $plattype, $plattitre, $platdescription, $platprix, basename($platimage));
        }
        else{
            $sql = "INSERT INTO item (idtype,titre,description,prix) values (?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issd", $plattype, $plattitre, $platdescription, $platprix);
        }
        $stmt->execute();
        $stmt->free_result();
        $stmt->close();
        $_SESSION['toast'] = "plat-ajout";
        $redirect = "admin";
    }
}
else{
    $_SESSION['toast'] = "erreur-plat";
    $redirect = "admin-plat";

}
?>

<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
