<?php
//trouve les plats de la semaine selon l'ordre des categories
$itemsBdId = array();
$itemsBdType = array();
$itemsBdTitre = array();
$itemsBdPrix = array();
$sql="SELECT i.id, pi.type, i.titre, i.prix FROM menu m JOIN menu_detail md ON m.id = md.idmenu JOIN item i ON md.iditem = i.id JOIN p_item pi ON i.idtype = pi.id WHERE m.isnow=1 ORDER BY pi.ordre, i.prix, i.titre;";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$stmt->bind_result($un,$deux,$trois, $quatre);
$j = 0;
while($stmt->fetch()) {
    $itemsBdId[] = (string)$un;
    $itemsBdType[] = $deux;
    $itemsBdTitre[] = $trois;
    $itemsBdPrix[] = $quatre;
}
$stmt->free_result();
$j = 0;
$htmltype = null;
echo "
<ul class=\"collapsible\" data-collapsible=\"accordion\">";
    for($j=0;$j<sizeof($itemsBdId);$j++) {
        echo "
                <li>";
                if(strcmp($htmltype,$itemsBdType[$j])!= 0){
                ?>
                <div class="menu-header <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>" style='pointer-events:none;'>
                        <div class="container"><h5><u>
                            <?php echo ucfirst(strtolower($itemsBdType[$j])); ?>
                                </u></h5>
                        </div>
                    </div>
                <?php } ?>
                    <div class="collapsible-header active <?php echo $_GLOBAL['couleur-menu-1a']. " " . $_GLOBAL['couleur-menu-1b'] ?>">
                        <div class="container">
                            <span class="<?php echo $_GLOBAL['couleur-menu-2a']. "-text text-" . $_GLOBAL['couleur-menu-2b'] ?>">
                                <b><?php echo ucfirst(strtolower($itemsBdTitre[$j])); ?></b>
                            </span>
                            <span class='secondary-content <?php echo $_GLOBAL['couleur-menu-3a']. "-text text-" . $_GLOBAL['couleur-menu-3b'] ?>'>
                                <b><?php echo $itemsBdPrix[$j]. "$" ?></b>
                            </span>
                        </div>
                    </div>
                    
                    <div class='collapsible-body' style='padding:0;'>
                        <span>
                            <div class="menu-back-img" style="background-image:url('https://i.ytimg.com/vi/jyaLMHBKCic/maxresdefault.jpg');">
                                <div class="menu-back-img-shadow">
                                    <div class="container">
                                        <div class='section'>
    <!--                                DEBUT container de l'item-->
                                            <div class="menu-container">
                                                <div class="section">
                                                    <div class="white-text row s12" style="margin:0px 20px 0px 20px;">

                                                        <h5 class="col s6"><?php echo $itemsBdTitre[$j]; ?></h5>
                                                        <input type="hidden" id="hiddenprix<?php echo $j; ?>" value="<?php echo $itemsBdPrix[$j]; ?>"/>
                                                        <h5 class="col s6 right-align"><?php echo $itemsBdPrix[$j]; ?>$</h5>

                                                        <div class="col s12" style="min-height: 180px;">
                                                            <img class="right hide-on-small-only" style="padding-left:20px;" src="css/ico/logo_blanc.png" width="auto" height="160px"/>
                                                            <h6>description a a a
                                                                description  a a a  description  a aaa adescriptio naaa
                                                                description  a a a adescription  aa description  aa a descriptiona a a
                                                                description  a  a a a a adescription  a aa description descriptiona a  a
                                                                description  a aa description  a aa description aaa  descriptiona a
                                                                description  a a a  description  a aaa adescriptio naaa
                                                                description  a a a adescription  aa description  aa a descriptiona a a
                                                                description  a  a a a a adescription  a aa description descriptiona a  a
                                                            </h6>
                                                        </div>
                                                        <div class="col s12">
                                                            <div class="row s12">
                                                                <form action="#" class="col s12">
                                                                    <div class="col s12" style="padding-left:0;padding-right: 0;">
                                                                        <div class="input-group col center" style="padding-left:0;padding-right: 0;">
                                                                            <span class="input-group-btn">
                                                                              <button type="button" class="col btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                                                                  <span><i class="material-icons">remove</i></span>
                                                                              </button>
                                                                            </span>
                                                                            <input type="text" name="quant[1]" class="form-control input-number center" value="1" min="1" max="100">
                                                                            <span class="input-group-btn">
                                                                              <button type="button" class="col btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                                                                  <span><i class="material-icons">add</i></span>
                                                                              </button>
                                                                            </span>
                                                                        </div>
                                                                        <div class="input-group-btn col hide-on-small-only">
                                                                            <button class="col btn btn-default waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">
                                                                                <span><i class="material-icons left">add_shopping_cart</i>Ajouter au panier</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group-btn col s12 hide-on-med-and-up" style="padding-left:0;padding-right: 0;">
                                                                        <button class="col btn btn-default waves-effect waves-light <?php echo $_GLOBAL['couleur1a']; ?>" type="submit" name="action">
                                                                            <span><i class="material-icons left">add_shopping_cart</i>Ajouter au panier</span>
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                                <div class="col s12"><label>Prix total : </label><span id="prixnumber"><?php echo $itemsBdPrix[$j]; ?></span> $</div>
                                                            </div>
                                                        </div>
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

                                            <script type="text/javascript">
                                                var prixUnit = document.getElementById('hiddenprix');
                                                var prixTotal = document.getElementById('prixnumber');
                                                $('.btn-number').click(function(e){
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
                                                $('.input-number').focusin(function(){
                                                    $(this).data('oldValue', $(this).val());
                                                });
                                                $('.input-number').change(function() {
                                                    prixUnit = parseFloat($('#hiddenprix1').val());
                                                    var prixTotal = $('#prixnumber');
                                                    minValue =  parseInt($(this).attr('min'));
                                                    maxValue =  parseInt($(this).attr('max'));
                                                    valueCurrent = parseInt($(this).val());

                                                    name = $(this).attr('name');
                                                    if(valueCurrent >= minValue) {
                                                        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
                                                    } else {
                                                        alert('Sorry, the minimum value was reached');
                                                        $(this).val($(this).data('oldValue'));
                                                    }
                                                    if(valueCurrent <= maxValue) {
                                                        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
                                                    } else {
                                                        alert('Sorry, the maximum value was reached');
                                                        $(this).val($(this).data('oldValue'));
                                                    }
                                                    prixTotal.text(prixUnit*valueCurrent);


                                                });
                                                $(".input-number").keydown(function (e) {
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
<!--echo"-->
<!--<div class=\"product-card\">-->
<!--    <div class=\"product-image\">-->
<!--        <a href='menu-item'>-->
<!--            <img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class=\"product-info\">-->
<!--        <h5>Manteau</h5>-->
<!--        <h6>$99.99</h6>-->
<!--    </div>-->
<!--</div>-->
