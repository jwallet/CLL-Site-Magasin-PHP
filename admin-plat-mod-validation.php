<?php
if(isset($_POST['mod-titre']) and isset($_POST['mod-prix'])and isset($_POST['mod-type'])) {
    include("bd-connect.php");
    ECHO $plattitre = $_POST['mod-titre'];
    echo "<br>";
    ECHO $platdescription = $_POST['mod-description'];
    echo "<br>";
    ECHO $platprix = $_POST['mod-prix'];
    echo "<br>";
    ECHO $plattype = $_POST['mod-type'];
    echo "<br>";
    echo $platimage = $_POST['mod-image-txt']; //retient le filename . extension
    echo "<br>";
    echo $extension = pathinfo($platimage, PATHINFO_EXTENSION); // retient l extension seulement
    echo "<br>";
    echo $filename = basename($platimage,".".$extension); // retient seulement le filename
    echo "<br>";
    //si le fichier existe
    if (isset($_FILES["mod-image"])){
        $index = 0;
        while(fileExists($_FILES["mod-image"]))
        {
            $index = $index+1;
            $platimage = $filename."(".$index.")." . $extension;
        }
        //copie du fichier du dossier temporaire au bon endroit
        if (!fileExists($_GLOBAL['dirimg'].$platimage)){
            if ( copy($_FILES["mod-image"]["tmp_name"],$_GLOBAL['dirimg'].$platimage)){
                echo "Transmission réussis!!!";
                echo "Code d'erreur=".$_FILES["mod-image"]["error"];
                code();
            }
            else {
                echo "Transmission non-réussis<P>";
                echo "Code d'erreur=".$_FILES["mod-image"]["error"];
                code();
            }
        }
    }
    $sql = "UPDATE item SET titre=?,description=?,prix=?,image=? WHERE id=?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssdsi", $plattitre,$platdescription,$platprix,$platimage,$_GET['id']);
    if ($stmt->execute()) {
        echo $plattitre;
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