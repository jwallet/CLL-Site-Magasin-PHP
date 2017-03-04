<?php
include("bd-connect.php");
if(isset($_SESSION['user-id']) and isset($_POST['email']) and
    isset($_POST['password'])){
    $sql = "UPDATE personne SET email = ? WHERE id = ? AND passe LIKE ?;";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sis",$email,$id,$password);

    $id = $_SESSION['user-id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt->execute();

    $_SESSION['user-email'] = $email;
    $_SESSION['toast']="email-changed";
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
