<?php
include("bd-connect.php");
if(isset($_SESSION['user-id']) and isset($_POST['telephone'])){
    $sql = "UPDATE personne SET telephone = ? WHERE id = ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("si",$telephone,$id);

    $id = $_SESSION['user-id'];
    $telephone = $_POST['telephone'];

    $stmt->execute();

    $_SESSION['user-telephone'] = $telephone;
    $_SESSION['toast']="phone-changed";
    $redirect = "account-infos";
}
else{
    $_SESSION['toast']="changed-failed";
    $redirect = "account-infos";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
