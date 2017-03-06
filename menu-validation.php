<?php
include("bd-connect.php");
if(isset($_SESSION['user-id']) and isset($_POST['jvalue'])){
    $jvalue = $_POST['jvalue']; //le rank de litem choisi sert a determiner le id des vars en POST

    if(isset($_POST['hiddenitem'.$jvalue]) and isset($_POST['quant'.$jvalue])){
        $iditem = $_POST['hiddenitem'.$jvalue];
        $quantitem = $_POST['quant'.$jvalue];

        if(isset($_COOKIE["shoppingcart"])) {
            $cookieval = $_COOKIE["shoppingcart"] . '|' . $iditem . ':' . $quantitem; //add an item id and quant
            setcookie("shoppingcart",$cookieval, time()+604800);//expire in a week
        }
        else{
            $cookieval = $iditem . ':' . $quantitem;
            setcookie("shoppingcart",$cookieval,time()+604800);//expire in a week
        }

        echo $_COOKIE['shoppingcart'];
        $_SESSION['toast']="order-added";
        $redirect = "shop-cart";
    }
    else
    {
        $_SESSION['toast']="order-failed";
        $redirect = "menu";
    }
}
else{
    $_SESSION['toast']="order-failed";
    $redirect = "menu";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
