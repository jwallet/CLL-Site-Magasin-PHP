<?php
if(isset($_POST['plat-titre']) and isset($_POST['plat-prix'])and isset($_POST['plat-type'])) {
    include("bd-connect.php");
    $plattitre = $_POST['plat-titre'];
    $platdescription = $_POST['plat-description'];
    $platprix = $_POST['plat-prix'];
    $plattype = $_POST['plat-type'];
    $platimage = basename($_FILES['plat-image']['name']); //retient le filename . extension
    $extension = pathinfo($platimage, PATHINFO_EXTENSION); // retient l extension seulement
    $filename = basename($_FILES['plat-image']['name'],".".$extension); // retient seulement le filename
    //si le fichier existe
    if (isset($_FILES["plat-image"])){
        $index = 0;
        while(fileExists($_GLOBAL['dirimg'].$platimage))
        {
            $index = $index+1;
            $platimage = $filename."(".$index.")." . $extension;
        }
        //copie du fichier du dossier temporaire au bon endroit
        if ( copy($_FILES["plat-image"]["tmp_name"],$_GLOBAL['dirimg'].$platimage)){
            echo "Transmission réussis!!!";
            echo "Code d'erreur=".$_FILES["plat-image"]["error"];
            code();
        }
        else {
            echo "Transmission non-réussis<P>";
            echo "Code d'erreur=".$_FILES["plat-image"]["error"];
            code();
        }
    }
    $sql = "INSERT INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issds", $plattype, $plattitre, $platdescription, $platprix, basename($platimage));
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
<?php
    function code()
    {
        echo "<br> 0= réussi, 1= taille du fichier trop grande selon php.ini";
        echo "<br> 2= taille du fichier trop grande selon formulaire, 3= partiellement transmis, 4= fichier non transmis";
    }
    function fileExists($path){
        return (@fopen($path,"r")==true);
    }
?>