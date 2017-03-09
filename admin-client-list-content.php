<?php
$personnesId = array();
$personnesPrenom = array();
$personnesNom = array();
$personnesTelephone = array();
$personnesAdresse = array();
$personnesEmail = array();
$stmt = $mysqli->prepare("SELECT id,email,prenom,nom,telephone,adresse FROM personne WHERE isadmin=0 order by nom;");
$stmt->execute();
$stmt->bind_result($id,$email,$prenom,$nom,$telephone,$adresse);
while($stmt->fetch()) {
    $personnesId[] = $id;
    $personnesPrenom[] = $prenom;
    $personnesNom[] = $nom;
    $personnesTelephone[] = $telephone;
    $personnesAdresse[] = $adresse;
    $personnesEmail[] = $email;
}
?>
<?php if (isset($_SESSION['toast']) == 'client-mod'){?>
    <script type="text/javascript">
        $(document).ready(function () {
            Materialize.toast('Le client a été mis à jour', 4000);
        });
    </script>
    <?php
} ?>
<div class="container col">
    <ul class="collection">
        <?php for($i=0; $i<sizeof($personnesId); $i++){?>
            <li class="collection-item avatar" style="padding-left:80px;">
                <a style="color:black;" href="admin-client?id=<?php echo $personnesId[$i]; ?>">
                    <span style="background-image:url('<?php if( $itemsImg[$i]!=null and  $itemsImg[$i]!=""){ echo "upload/".$itemsImg[$i];} else { echo "css/ico/logo.png"; } ?>');background-position:center;background-size:auto 60px;width:60px;height: 60px; margin-top:-8px;margin-left:-6px;" alt="" class="circle"></span>
                    <span class="title">
                        <?php echo $personnesEmail[$i]; ?>
                    </span>
                    <span class="<?php echo $_GLOBAL['couleur2a']; ?>-text" style="padding-left:8px;font-size:14px;font-style: italic;">
                            <?php echo ucfirst(strtolower($personnesPrenom[$i])) . " " . ucfirst(strtolower($personnesNom[$i])); ?>
                        </span><br/>
                    <span style="font-size:85%;">
                            <?php echo ucfirst(strtolower($personnesTelephone[$i])); ?>
                            <br>
                        </span>
                    <span style="font-size:85%;">
                            <?php echo $personnesAdresse[$i]; ?>
                        </span>
                </a>
            </li>
            <?php
        }?>
    </ul>
</div>