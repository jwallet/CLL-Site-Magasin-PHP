<?php
if(isset($_GET['mod-titre']) and isset($_GET['mod-prix'])and isset($_GET['mod-type'])) {
    include("bd-connect.php");
    ECHO $plattitre = $_GET['mod-titre'];
    echo "<br>";
    ECHO $platdescription = $_GET['mod-description'];
    echo "<br>";
    ECHO $platprix = $_GET['mod-prix'];
    echo "<br>";
    ECHO $plattype = $_GET['mod-type'];
    echo "<br>";
    ECHO $platimage = basename($_FILES['mod-image']['name']); //retient le filename . extension
    echo "<br>";
    ECHO $extension = pathinfo($platimage, PATHINFO_EXTENSION); // retient l extension seulement
    echo "<br>";
    ECHO $filename = basename($_FILES['mod-image']['name'],".".$extension); // retient seulement le filename
    echo "<br>";
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
//    $sql = "UPDATE INTO item (idtype,titre,description,prix,image) values (?,?,?,?,?)";
//    $stmt = $mysqli->prepare($sql);
//    $stmt->bind_param("issds", $plattype, $plattitre, $platdescription, $platprix, basename($platimage));
//    if ($stmt->execute()) {
//        $_SESSION['toast'] = "plat-ajout";
//        $redirect = "admin";
//    }
//    $stmt->free_result();
//    $stmt->close();
    $sql = "UPDATE item SET titre=$plattitre,description=$platdescription,prix=$platprix,image=basename($platimage) WHERE id=?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    if ($stmt->execute()) {
        $_SESSION['toast'] = "plat-type-mod";
        $redirect = "admin-plat-mod";
    }
    $stmt->free_result();
    $stmt->close();
}
?>
    <html>
    <head>
<!--        <meta http-equiv="refresh" content="0;URL='--><?php //echo $redirect; ?><!--'"/>-->
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