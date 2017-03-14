<?php
if(isset($_POST['titre']) and isset($_POST['prix'])and isset($_POST['type'])) {
    include("bd-connect.php");
    include("meta.php");
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        $id = "";
    }
    $platimage = "";
    $plattitre = $_POST['titre'];
    $platdescription = $_POST['description'];
    $platprix = (double)$_POST['prix'];
    $plattype = number_format($_POST['type'],2,".","");

    if(($_POST['image-txt'])!="") {
        $platimage = strtolower(str_replace(array(' ','(',')'), '', basename($_FILES['image']['name']))); //retient le filename . extension
        $extension = strtolower(pathinfo($platimage, PATHINFO_EXTENSION)); // retient l extension seulement
        $filename = strtolower(str_replace(array(' ','(',')'), '', basename($_FILES['image']['name'], "." . $extension))); // retient seulement le filename
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
            $sql = "UPDATE item SET idtype=?,titre=?,description=?,prix=?,image=? WHERE id=?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issdsi", $plattype,$plattitre, $platdescription, $platprix, $platimage, $id);
        } else {
            $sql = "UPDATE item SET idtype=?,titre=?,description=?,prix=? WHERE id=?;";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issdi", $plattype, $plattitre, $platdescription, $platprix, $id);
        }
        $stmt->execute();
        $stmt->close();
        $_SESSION['toast'] = "plat-mod";
        $redirect = "admin-plat-list";

    } else {
        if ($platimage != "") {
            $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issds", $plattype, $plattitre, $platdescription, $platprix, basename($platimage));
        } else {
            $sql = "INSERT INTO item (idtype,titre,description,prix) values (?,?,?,?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("issd", $plattype, $plattitre, $platdescription, $platprix);
        }
        $stmt->execute();
        $stmt->close();
        $_SESSION['toast'] = "plat-ajout";
        $redirect = "admin";
    }

}
//elseif(isset($_POST['titre']) and isset($_POST['platsupp']) and isset($_POST['prix'])and isset($_POST['type'])) {
//    include("bd-connect.php");
//    include("meta.php");
//    $platimage = "";
//    $plattitre = $_POST['titre'];
//    $platdescription = $_POST['description'];
//    $platprix = $_POST['prix'];
//    $plattype = $_POST['type'];
//    $platimage = basename($_FILES['image']['name']); //retient le filename . extension
//    $extension = pathinfo($platimage, PATHINFO_EXTENSION); // retient l extension seulement
//    $filename = basename($_FILES['image']['name'], "." . $extension); // retient seulement le filename
//    if (isset($_FILES["image"])) {
//        //copie du fichier du dossier temporaire au bon endroit
//        if (@fopen($_GLOBAL['dirimg'] . $platimage, "r")) {
//            unlink($_GLOBAL['dirimg'] . $platimage);
//        }
//    }
//    $sql = "DELETE FROM item WHERE id=?;";
//    $stmt = $mysqli->prepare($sql);
//    $stmt->bind_param("i", $_GET['id']);
//    if ($stmt->execute()) {
//        $_SESSION['toast'] = "plat-type-mod";
//        $redirect = "admin-plat-mod";
//    }
//    $stmt->free_result();
//    $stmt->close();
//}
else
{
    if(isset($_GET['idout'])){
        include("bd-connect.php");
        include("meta.php");
        //on efface le id, le call vient du bouton delete dans la liste des items
        // on cherche limage associer avant
        $id = (integer)$_GET['idout'];
        $sql = "SELECT image FROM item WHERE id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($imagetoremove);
        $stmt->fetch();
        //si ya une image on la delete de upload
        if($imgtorem!=null and $imgtorem!=""){
            if (@fopen($_GLOBAL['dirimg'] . $imagetoremove, "r")) {
                unlink($_GLOBAL['dirimg'] . $imagetoremove);
            }
        }
        $stmt->free_result();
        $stmt->close();
        //on fini par retirer litem de la bd
        $sql = "DELETE FROM item WHERE id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $_SESSION['toast'] = "plat-del";
            $redirect = "admin-plat-list";
        }
        $stmt->close();
    }
    else{
        $_SESSION['toast'] = "erreur-plat";
        $redirect = "admin";
    }
}
?>

<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
