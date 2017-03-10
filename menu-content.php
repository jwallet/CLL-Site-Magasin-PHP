<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'item-failed') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('L\'ajout du plat a échoué.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
//trouve les plats de la semaine selon l'ordre des categories
$itemsBdId = array();
$itemsBdType = array();
$itemsBdTitre = array();
$itemsBdDesc = array();
$itemsBdImg = array();
$itemsBdPrix = array();
$itemsBdOrdre = array();
$sql="SELECT i.id, pi.type, i.titre, i.description, i.image, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre";
$stmt = $mysqli->prepare($sql);
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
$j = 0;
$htmltype = null;
echo "
<ul class=\"collapsible chalk-board-small\" data-collapsible=\"accordion\" style=\"border:none;\">";
    for($j=0;$j<sizeof($itemsBdId);$j++) {
        echo "
                <li>";
                if(strcmp($htmltype,$itemsBdType[$j])!= 0){
                ?>
                <div class="menu-header <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>" style='font-variant:small-caps; pointer-events:none;border:0px;background-image:url("css/res/blackboard.jpg");background-repeat: repeat;background-size:175px 175px;'>
                    <div class="container">
                        <h4 style="margin-top:39px;" class="center <?php echo $_GLOBAL['couleur-menu-4a']. "-text"; ?>">
                            <?php echo ucfirst(strtolower($itemsBdType[$j])); ?>
                        </h4>
                    </div>
                </div>
                <?php }?>
                    <div class="collapsible-header <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>" style="border:0px;background-image:url('css/res/blackboard.jpg');background-repeat: repeat;background-size:175px 175px;background-position-y: 100px;">
                        <div class="container" style="font-size:1.4em;border-bottom: 2px dotted rgb(145, 145, 145);">
                            <span class="<?php echo $_GLOBAL['couleur-menu-3a']. "-text text-" . $_GLOBAL['couleur-menu-3b'] ?>">
                                <?php echo ucfirst(strtolower($itemsBdTitre[$j])); ?>
                            </span>
                            <span class='secondary-content <?php echo $_GLOBAL['couleur-menu-3a']. "-text text-" . $_GLOBAL['couleur-menu-3b'] ?>'>
                                <?php echo money_format('%(#10n', ($itemsBdPrix[$j]));?>
                            </span>
                        </div>
                        <div class="container <?php echo $_GLOBAL['couleur-menu-2a']. "-text text-" . $_GLOBAL['couleur-menu-2b'] ?>" style="font-size:1.2em;font-style: italic;">
                            <span><?php if($itemsBdDesc[$j]!=null and $itemsBdDesc[$j]!=""){ echo $itemsBdDesc[$j]; } else { echo "Aucune description n'est disponible."; } ?></span>
                        </div>
                    </div>
                    
                    <div class='collapsible-body' style='padding:0;'>
                        <span>
                            <div class="menu-back-img" style="background-image:url('<?php if($itemsBdImg[$j]!="" and $itemsBdImg[$j]!=null){ echo "upload/$itemsBdImg[$j]"; } else { echo "http://www.harristonmintofair.ca/wp-content/uploads/2015/07/o-CHICKEN-WINGS-facebook.jpg";} ?>');">
                                <div class="menu-back-img-shadow">
                                    <div class="container">
                                        <div class='section'>
    <!--                                DEBUT container de l'item-->
                                            <div class="menu-container" style="font-family: 'Roboto', sans-serif;font-weight: normal;">
                                                <div class="section">
                                                    <div class="white-text" style="margin:0px 20px 0px 20px;">

                                                        <div style="float:right; border-radius:70px;background-image:url('<?php if( $itemsBdImg[$j]!=null and  $itemsBdImg[$j]!=""){ echo "upload/".$itemsBdImg[$j];} else { echo "css/ico/logo.png"; } ?>');background-position:center;background-size:auto 140px;width:140px;height: 140px; margin-right:-10px;" alt=""></div>
                                                        <h5 class="col s12"><?php echo ucfirst(strtolower($itemsBdTitre[$j])); ?></h5>
                                                        <p class="col s12" style="min-height: 100px;"><?php if($itemsBdDesc[$j]!=null and $itemsBdDesc[$j]!=""){ echo $itemsBdDesc[$j]; } else { echo "Aucune description n'est disponible."; } ?></p>
                                                        <?php if(isset($_SESSION['user-online'])){?>
                                                        <div class="row s12" style="margin:0;padding:0;">

                                                            <form action="menu-validation" method="post">
                                                                <input type="hidden" name="jvalue" value="<?php echo $j; ?>"/>
                                                                <input type="hidden" class="hiddenprix<?php echo $j; ?>" value="<?php echo $itemsBdPrix[$j]; ?>"/>
                                                                <input type="hidden" name="hiddenitem<?php echo $j; ?>" value="<?php echo $itemsBdId[$j]; ?>"/>
                                                                <label style="font-size:95%;">Prix unitaire : </label><span style="font-size:120%;"><?php echo money_format('%(#10n', ($itemsBdPrix[$j]));?></span>
                                                                <div class="col s12" style="padding-left:0;padding-right: 0;">
                                                                    <div class="input-group col center" style="padding-left:0;padding-right: 0;">
                                                                        <span class="input-group-btn">
                                                                          <button type="button" class="col btn btn-default btn-number<?php echo $j; ?> <?php echo $_GLOBAL['couleur1a']; ?>" disabled="disabled" data-type="minus" data-field="quant<?php echo $j; ?>">
                                                                              <span><i class="material-icons">remove</i></span>
                                                                          </button>
                                                                        </span>
                                                                        <input type="text" style="width: 50px;margin:0;margin-top:-28px;padding:0;height: 2.2rem;border:2px solid #CCC;" name="quant<?php echo $j; ?>" class="form-control input-number<?php echo $j; ?> center" value="1" min="1" max="1000">
                                                                        <span class="input-group-btn">
                                                                          <button type="button" class="col btn btn-default btn-number<?php echo $j; ?> <?php echo $_GLOBAL['couleur1a']; ?>" data-type="plus" data-field="quant<?php echo $j; ?>">
                                                                              <span><i class="material-icons">add</i></span>
                                                                          </button>
                                                                        </span>
                                                                    </div>
                                                                    <div class="input-group-btn col hide-on-small-only">
                                                                        <button class="col btn btn-default waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">
                                                                            <span><i class="material-icons left">add_shopping_cart</i>Ajouter au panier</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="col s12 input-group-btn col hide-on-med-and-up" style="padding:0;padding-top:18px;">
                                                                        <button style="width:100%;" class="btn btn-default waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">
                                                                            <span><i class="material-icons left">add_shopping_cart</i>Ajouter au panier</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <label>Prix total : </label><span class="prixnumber<?php echo $j; ?>"><?php echo money_format('%(#10n', ($itemsBdPrix[$j]));?></span>
                                                        </div>

                                                        <script type="text/javascript">
                                                            $('.btn-number<?php echo $j; ?>').click(function(e){
                                                                e.preventDefault();

                                                                fieldName = $(this).attr('data-field');
                                                                type      = $(this).attr('data-type');
                                                                var input = $("input[name='"+fieldName+"']");
                                                                var currentVal = parseInt(input.val());
                                                                if (!isNaN(currentVal)) {
                                                                    if(type == 'minus') {

                                                                        if(currentVal > input.attr('min')) {
                                                                            input.val(currentVal - 1).change();
                                                                        }
                                                                        if(parseInt(input.val()) == input.attr('min')) {
                                                                            $(this).attr('disabled', true);
                                                                        }

                                                                    } else if(type == 'plus') {

                                                                        if(currentVal < input.attr('max')) {
                                                                            input.val(currentVal + 1).change();
                                                                        }
                                                                        if(parseInt(input.val()) == input.attr('max')) {
                                                                            $(this).attr('disabled', true);
                                                                        }

                                                                    }
                                                                } else {
                                                                    input.val(0);
                                                                }
                                                            });
                                                            $('.input-number<?php echo $j; ?>').focusin(function(){
                                                                $(this).data('oldValue', $(this).val());
                                                            });
                                                            $('.input-number<?php echo $j; ?>').change(function() {
                                                                prixUnit = parseFloat($('.hiddenprix<?php echo $j; ?>').val());
                                                                var prixTotal = $('.prixnumber<?php echo $j; ?>');
                                                                minValue =  parseInt($(this).attr('min'));
                                                                maxValue =  parseInt($(this).attr('max'));
                                                                valueCurrent = parseInt($(this).val());

                                                                name = $(this).attr('name');
                                                                if(valueCurrent >= minValue) {
                                                                    $(".btn-number<?php echo $j; ?>[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                                                                } else {
                                                                    alert('Sorry, the minimum value was reached');
                                                                    $(this).val($(this).data('oldValue'));
                                                                }
                                                                if(valueCurrent <= maxValue) {
                                                                    $(".btn-number<?php echo $j; ?>[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                                                                } else {
                                                                    alert('Désolé, la limite est atteinte.');
                                                                    $(this).val($(this).data('oldValue'));
                                                                }
                                                                //prixTotal.text(prixUnit*valueCurrent);
                                                                prixTotal.text(parseFloat((prixUnit*valueCurrent), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1 ").toString() + "$");


                                                            });
                                                            $('.input-number<?php echo $j; ?>').keydown(function (e) {
                                                                // Allow: backspace, delete, tab, escape, enter and .
                                                                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                                                                    // Allow: Ctrl+A
                                                                    (e.keyCode == 65 && e.ctrlKey === true) ||
                                                                    // Allow: home, end, left, right
                                                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                                                    // let it happen, don't do anything
                                                                    return;
                                                                }
                                                                // Ensure that it is a number and stop the keypress
                                                                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                                                    e.preventDefault();
                                                                }
                                                            });
                                                        </script>
                                                        <?php }
                                                        else{?>
                                                            <div class="col s12" style="padding-left:0;padding-right: 0;">
                                                                <a href="connect" style="width:100%;" class="btn btn-default waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>">
                                                                    <span>Connectez-vous</span>
                                                                </a>
                                                            </div>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
    <!--                                FIN container de l'item-->
    <?php
        echo "                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div>
                </li>
        ";
        $htmltype = $itemsBdType[$j];
    }

echo "
</ul>";
?>
<style>

  input[type=range]::-webkit-slider-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>;
  }
  input[type=range]::-moz-range-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>
  }
  input[type=range]::-ms-thumb {
      background-color: <?php echo $_GLOBAL['couleur1a']; ?>;
  }

  /***** These are to edit the thumb and the text inside the thumb *****/
  input[type=range] + .thumb {
      background-color: whitesmoke;
  }
  input[type=range] + .thumb.active .value {
      color: <?php echo $_GLOBAL['couleur1a']; ?>; }
</style>
