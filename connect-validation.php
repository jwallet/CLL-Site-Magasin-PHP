<?php
include("bd-connect.php");
if(isset($_POST['email']) and isset($_POST['password'])){

    $sql = "SELECT prenom, nom FROM personne WHERE email LIKE ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss",$email,$passe);

    $email = $_POST['email'];
    $passe = md5($_POST['password']);

    $stmt->execute();

    $stmt->bind_result($prenom, $nom);

    if($stmt->fetch()){
        echo "usager trouve " .$prenom. " ". $nom;
    }
    else{
        echo "ERREUR PAS TROUVE";
    }
}
else{
    echo "ERREUR FORMULAIRE";
}
?>