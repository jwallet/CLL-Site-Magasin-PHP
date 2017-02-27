<?php
include("bd-connect.php");
if(isset($_SESSION['user-id']) and isset($_POST['oldpassword']) and
    isset($_POST['new2password'])){
    $sql = "UPDATE personne SET passe = ? WHERE id = ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss",$newpassword,$id,$passe);

    $id = $_SESSION['user-id'];
    $passe = md5($_POST['oldpassword']);
    $newpassword = md5($_POST['new2password']);

    $stmt->execute();

    $_SESSION['user-passe'] = $passe;
    $_SESSION['toast']="password-changed";
    $redirect = "account";
}
else{
    $_SESSION['toast']="password-changed-failed";
    $redirect = "account";
}
?>
<html>
<head>
    <meta http-equiv="refresh" content="0;URL='<?php echo $redirect; ?>'"/>
</head>
</html>
