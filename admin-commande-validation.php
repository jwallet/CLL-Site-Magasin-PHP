<?php
if(isset($_POST['commandeEnrg']) and isset($_POST['idmenu']) and isset($_POST['idpersonne'])) {
    include("bd-connect.php");
    $idmenu = $_POST['idmenu'];
    $idpersonne = $_POST['idpersonne'];
    //Aller chercher les repas du menu de la semaine
    $stmt = $mysqli->prepare("SELECT i.id, pi.type, i.titre, i.description, i.image, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre;");
    $stmt->execute();
    $stmt->bind_result($un,$deux,$trois, $quatre, $cinq, $six);
    $j = 0;
    while($stmt->fetch()) {
        $itemsBdId[] = (string)$un;
        $itemsBdType[] = $deux;
        $itemsBdTitre[] = $trois;
        $itemsBdDesc[] = $quatre;
        $itemsBdImg[] = $cinq;
        $itemsBdPrix[] = $six;
    }
    $stmt->free_result();
    for($i=0; $i<sizeof($itemsBdId); $i++){
        //Verif sil y a une commande sur cet item, ce client et ce menu dans la BD
        $stmt = $mysqli->prepare("SELECT cd.id FROM commande_detail cd JOIN commande c ON cd.idcommande = c.id WHERE c.idpersonne=? and c.idmenu=? and cd.iditem=?;");
        $stmt->bind_param("iii",$idpersonne,$idmenu,$itemsBdId[$i]);
        $stmt->execute();
        $stmt->bind_result($idcommandedetail);
        //Si la commande place par le client contenait une quantite pour le produit selectionne, on le met a jour tout simplement
        if($stmt->fetch()){
            $stmt->free_result();
            $stmt = $mysqli->prepare("UPDATE commande_detail cd SET quantite=? WHERE cd.id=?;");
            $stmt->bind_param("ii",$_POST["quantite" . $itemsBdId[$i]],$idcommandedetail);
            $stmt->execute();
            $stmt->free_result();
        }
        //Si aucune quantite a ete placer dans commande_detail, aller creer la row
        else
        {
            //Verification si le client avait mis une commande dans la table commande, sinon en creer une
            $stmt = $mysqli->prepare("SELECT c.id FROM commande c where c.idpersonne=? and c.idmenu=?;");
            $stmt->bind_param("ii",$idpersonne,$idmenu);
            $stmt->execute();
            $stmt->bind_result($idcommande);
            //Insere une nouvelle commande pour le client avec le menu actuel
            if(!$stmt->fetch()){
                $stmt = $mysqli->prepare("INSERT INTO commande (idpersonne,date,idmenu) VALUES(?,?,?);");
                $stmt->bind_param("isi",$idpersonne,date('Y-m-d'),$idmenu);
                $stmt->execute();
                $stmt->free_result();
                //Aller rechercher l id de la commande qu on vient de creer
                $stmt = $mysqli->prepare("SELECT id FROM commande WHERE idpersonne=? and idmenu=?;");
                $stmt->bind_param("ii",$idpersonne,$idmenu);
                $stmt->execute();
                $stmt->bind_result($idcommande);
            }
            $stmt->free_result();
            //Aller inserer dans commande_detail avec les infos entres par l admin
            $stmt = $mysqli->prepare("INSERT INTO commande_detail (idcommande,iditem,quantite) VALUES(?,?,?);");
            $stmt->bind_param("isi",$idcommande,$itemsBdId[$i],$_POST["quantite" . $itemsBdId[$i]]);
            $stmt->execute();
            $stmt->free_result();
        }
        $redirect = "admin-commande-list";
        $_SESSION['toast'] = "mod-commande";
    }
}
else{
    $redirect = "admin-commande-list";
    $_SESSION['toast'] = "erreur-commande";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>