<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'order-added') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Commande ajoutée.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}
if(isset($_COOKIE["shoppingcart"])) {
    $itemsid = array();
    $itemsquant = array();
    $entries = explode("|",$_COOKIE["shoppingcart"]);
    foreach ($entries as $item){
        list($id,$quant) = explode(":", $item);
        $itemsid[] = $id;
        $itemsquant[] = $quant;
    }
}
?>
<ul class="collection">
    <li class="collection-item avatar">
        <img src="upload/img.jpg" alt="" class="circle">
        <span class="title">ITEM_TITLE</span>
        <p><input style="width: 50px;margin:0;padding:0;height: 1.4rem;border:1px solid #AAA;" type="number"/> <a style="padding-right:0px;" href="#!" class="<?php echo $_GLOBAL['couleur1a']."-text"; ?>"><i class="left material-icons">update</i></a>
            <a href="#!" class="<?php echo $_GLOBAL['couleur1a']."-text"; ?>"><i class="right material-icons">delete</i></a>
            </p>
        <a href="#!" class="secondary-content">PRICE</a>
    </li>
</ul>