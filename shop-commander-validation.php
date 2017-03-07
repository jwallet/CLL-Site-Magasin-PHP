<?php
include("bd-connect.php");
if(isset($_COOKIE['shoppingcart']) and (date("N")<=$_GLOBAL['jour-limite-commander'])){
    $sql = "SELECT id FROM menu WHERE isnow=1";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($un);
    $stmt->fetch();
    $idmenu = $un;
    $stmt->free_result();

    if(isset($_COOKIE["shoppingcart"])) {
        $cookie = explode(">",$_COOKIE["shoppingcart"]);
        $idmenucookie = (integer)$cookie[0];

        if($idmenucookie==$idmenu){
            $entries = explode("|",$cookie[1]);
            $j=0;
            $updated=false;
            $newcookieval="";
            //check if an item needs to be updated before adding a new one into the list
            foreach ($entries as $item){
                list($id,$quant) = explode(":", $item);
                if($id==$iditem){
                    $updated=true;
                    $quant = $quantitem + $quant;
                }
                if($j==0) {
                    $newcookieval = $idmenucookie. '>' . $id . ':' . $quant;
                }
                else{
                    $newcookieval = $newcookieval . '|' . $id . ':' . $quant;
                }
                $j++;
            }
            if($updated){
                $cookieval = $newcookieval;//if updated change current cookie to this one
            }
            else {
                $cookieval = $_COOKIE["shoppingcart"] . '|' . $iditem . ':' . $quantitem; //add an item id and quant
            }
            setcookie("shoppingcart",$cookieval, time()+604800);//expire in a week
        }
        else{
            $cookieval = $idmenu . '>' . $iditem . ':' . $quantitem;
            setcookie("shoppingcart",$cookieval,time()+604800);//expire in a week
        }
    }
    else{
        $cookieval = $idmenu . '>' . $iditem . ':' . $quantitem;
        setcookie("shoppingcart",$cookieval,time()+604800);//expire in a week
    }
    $_SESSION['toast']="order-added";
    $redirect = "shop-commander";
}
else{
    $_SESSION['toast']="order-failed";
    $redirect = "shop-cart";
}
?>
<html>
<head>
<!--    <meta http-equiv="refresh" content="0;URL='--><?php //echo $redirect; ?><!--'"/>-->
</head>
</html>
