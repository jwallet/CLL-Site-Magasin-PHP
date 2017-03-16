<?php
$personnesId = array();
$personnesPrenom = array();
$personnesNom = array();
$personnesTelephone = array();
$personnesAdresse = array();
$personnesEmail = array();
$personnesType = array();
$stmt = $mysqli->prepare("SELECT id,email,prenom,nom,telephone,adresse,isnew FROM personne WHERE isadmin=0 order by isnew, nom;");
$stmt->execute();
$stmt->bind_result($id,$email,$prenom,$nom,$telephone,$adresse,$isnew);
while($stmt->fetch()) {
    $personnesId[] = $id;
    $personnesPrenom[] = $prenom;
    $personnesNom[] = $nom;
    $personnesTelephone[] = $telephone;
    $personnesAdresse[] = $adresse;
    $personnesEmail[] = $email;
    $personnesType[] = $isnew;
}
?>
<?php if (isset($_SESSION['toast']) == 'client-mod'){?>
    <script type="text/javascript">
        $(document).ready(function () {
            Materialize.toast('Le client a été mis à jour', 4000);
        });
    </script>
    <?php
} elseif (isset($_SESSION['toast']) == 'client-del') {
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            Materialize.toast('Le client a été désactivé avec succès', 3000);
        });
    </script>
    <?php
}
unset($_SESSION['toast']); ?>
<div class="container col">
    <ul class="collection">
        <?php for($i=0; $i<sizeof($personnesId); $i++){?>
            <li class="collection-item avatar" style="padding-left:15px;">
                <a style="color:black;" href="admin-client?id=<?php echo $personnesId[$i]; ?>">
                    <span class="title">
                        <?php echo ucfirst(strtolower($personnesPrenom[$i])) . " " . ucfirst(strtolower($personnesNom[$i])); ?>
                    </span><i class="material-icons btn-floating grey" style="margin-top:-5px;margin-left:10px;line-height:1.2;width:21px;height:21px;font-size:130%;"><?php if ($personnesType[$i] < 2) { echo "visibility"; } else { echo "visibility_off";} ?></i>
                    <br/>
                    <span style="font-size:85%;">
                            <?php echo $personnesEmail[$i]; ?>
                        </span><br/>
                    <span style="font-size:85%;" class="<?php echo $_GLOBAL['couleur2a']; ?>-text">
                            <?php echo ucfirst(strtolower($personnesTelephone[$i])); ?>
                            <br>
                        </span>
                    <span style="font-size:75%;" class="<?php echo $_GLOBAL['couleur2a']; ?>-text">
                            <?php echo $personnesAdresse[$i]; ?>
                        </span>
                    <?php if ($personnesType[$i] < 2) { ?>
                        <div id="modalDelItem<?php echo $i; ?>" class="modal">
                        <div class="modal-content">
                            <h4>Désactivation Client</h4>
                            <p><h5>Etes-vous certain de vouloir désactiver ce client?</h5>
                            <b>Nom:</b> <?php echo ucfirst(strtolower($personnesPrenom[$i] . " " . $personnesNom[$i])); ?><br/>
                            <b>email:</b> <?php echo ucfirst(strtolower($personnesEmail[$i])); ?><br/>
                            <b>Telephone:</b> <?php echo ucfirst(strtolower($personnesTelephone[$i])); ?>
                        </div>
                        <div class="modal-footer">
                            <a href="admin-client-validation?idout=<?php echo $personnesId[$i]; ?>" class="btn modal-action modal-close waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>">Oui</a>
                            <a class="modal-action modal-close waves-effect waves-light btn-flat"><b>Non, annuler</b></a>
                        </div>
                    </div>
                    <a href="#modalDelItem<?php echo $i; ?>" class="btn-floating <?php echo $_GLOBAL['couleur1a']; ?> secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text"><i class="material-icons">delete</i></a>
                    <?php }else
                    { ?>
                         <div id="modalActClient<?php echo $i; ?>" class="modal">
                        <div class="modal-content">
                            <h4>Désactivation Client</h4>
                            <p><h5>Etes-vous certain de vouloir activer ce client?</h5>
                            <b>Nom:</b> <?php echo ucfirst(strtolower($personnesPrenom[$i] . " " . $personnesNom[$i])); ?><br/>
                            <b>email:</b> <?php echo ucfirst(strtolower($personnesEmail[$i])); ?><br/>
                            <b>Telephone:</b> <?php echo ucfirst(strtolower($personnesTelephone[$i])); ?>
                        </div>
                        <div class="modal-footer">
                            <a href="admin-client-validation?idin=<?php echo $personnesId[$i]; ?>" class="btn modal-action modal-close waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>">Oui</a>
                            <a class="modal-action modal-close waves-effect waves-light btn-flat"><b>Non, annuler</b></a>
                        </div>
                    </div>
                    <a href="#modalActClient<?php echo $i; ?>" class="btn-floating <?php echo $_GLOBAL['couleur1a']; ?> secondary-content <?php echo $_GLOBAL['couleur1a']; ?>-text"><i class="material-icons">delete</i></a>
                    <?php
                    }
                    ?>
                </a>
            </li>
            <?php
        }?>
    </ul>
</div>

<script type="text/javascript">
    $('.modal').modal();
</script>