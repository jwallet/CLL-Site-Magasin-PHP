<?php
if(isset($_POST['plat-titre']) and isset($_POST['plat-prix'])and isset($_POST['plat-type'])) {
    include("bd-connect.php");
    $plattitre = $_POST['plat-titre'];
    $platdescription = $_POST['plat-description'];
    $platprix = $_POST['plat-prix'];
    $plattype = $_POST['plat-type'];

    $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";
    $target_dir = "upload/";
    $target_file = $target_dir . ($_FILES["plat-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["plat-image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    $platimage = $_POST['plat-image'];
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
<!--    <meta http-equiv="refresh" content="0;URL='--><?php //echo $redirect; ?><!--'"/>-->
</head>
</html>
<?php
    function code()
    {
        echo "<br> 0= réussi, 1= taille du fichier trop grande selon php.ini";
        echo "<br> 2= taille du fichier trop grande selon formulaire, 3= partiellement transmis, 4= fichier non transmis";
    }
?>