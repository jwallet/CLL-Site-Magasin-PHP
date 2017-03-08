<?php
include("bd-connect.php");
include("meta.php");
if(isset($_COOKIE['shoppingcart']) and isset($_SESSION['user-id']) and (date("N")<=$_GLOBAL['jour-limite-commander'])){
    $sql = "SELECT id FROM menu WHERE isnow=1";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($un);
    $stmt->fetch();
    $idmenu = $un;
    $stmt->free_result();
    $stmt->close();

    $cookie = explode(">",$_COOKIE["shoppingcart"]);
    $idmenucookie = (integer)$cookie[0];
    $idpersonne = $_SESSION['user-id'];
    if($idmenucookie==$idmenu){
        $idcommande = 0;
        //select idcommande si existe
        $sql ="SELECT id FROM commande WHERE idpersonne=? AND idmenu=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $idpersonne, $idmenu);
        $stmt->execute();
        $stmt->bind_result($deux);
        if($stmt->fetch()) {
            $idcommande = $deux;
            $stmt->free_result();
            $stmt->close();
        }
        else{
            $stmt->free_result();
            $stmt->close();

            //insert new commande
            $sql="INSERT INTO commande (idpersonne, date, idmenu) VALUES (?,?,?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("isi",  $idpersonne, date('Y-m-d'), $idmenu);
            $stmt->execute();
            $stmt->free_result();
            $stmt->close();

            //select idcommande nouvellement cree
            $sql ="SELECT id FROM commande WHERE idpersonne=? AND idmenu=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ii",  $idpersonne, $idmenu);
            $stmt->execute();
            $stmt->bind_result($trois);
            $stmt->fetch();
            $idcommande = $trois;
            $stmt->free_result();
            $stmt->close();
        }
        $entries = explode("|",$cookie[1]);
        $j=0;
        foreach ($entries as $item){
            list($id,$quant) = explode(":", $item);

            //insert items in commande detail
            $sql="INSERT INTO commande_detail (idcommande, iditem, quantite) VALUES (?,?,?);";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("iii", $idcommande, $id, $quant);
            $stmt->execute();
            $stmt->free_result();
            $stmt->close();
            $j++;
        }
        setcookie("shoppingcart",null, time()-1);//expired
        $_SESSION['toast']="order-added";
        $redirect = "shop-commander";
    }
    else{
        setcookie("shoppingcart",null, time()-1);//expired
        $_SESSION['toast']="order-failed";
        $redirect = "shop-cart";

    }
}
else{
    $_SESSION['toast']="order-failed";
    $redirect = "shop-cart";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
