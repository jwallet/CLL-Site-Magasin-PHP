<?php
$j = 0;
echo "<ul class=\"collapsible\" data-collapsible=\"accordion\">";
    while($j<5){
        echo "
            
            <li>
                <div class=\"collapsible-header\">
                    <div class=\"container\">
                        <span class='secondary-content'>14</span>Menu principal                        
                    </div>
                </div>
                <div class=\"collapsible-body\">
                    <div class=\"container\">
                        <span class=\"products\">
                        ";

                        $i = 0;
                        while($i<5) {
                            $i++;
                            echo"
                            <div class=\"product-card\">
                                <div class=\"product-image\">
                                    <a href='shop-item.php'>
                                        <img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
                                    </a>
                                </div>
                                <div class=\"product-info\">
                                    <h5>Manteau</h5>
                                    <h6>$99.99</h6>
                                </div>
                            </div>
                        ";
                        }

                        echo "
                    </span>
                </div>
                </div>
            </li>        
        ";
        $j++;
    }
echo "</ul>";
?>