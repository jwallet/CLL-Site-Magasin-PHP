<?php
if(isset($_SESSION['toast'])) {
    if ($_SESSION['toast'] == 'order-added') {
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                Materialize.toast('Commande envoyée.', 8000);
            });
        </script>
        <?php
    }
    unset($_SESSION['toast']);
}