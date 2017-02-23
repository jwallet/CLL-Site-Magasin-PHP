<?php $expend = $_REQUEST["expend"] ?>
<div class="collection">
    <a href="shop.php?expend=1" class="collection-item black-text
        <?php if($expend==1) {
            echo "grey lighten-3 active";
        } else {
            echo "grey lighten-5";
        } ?>">
        <div class="container">
            <span class="badge">14</span>
            Menu principal
        </div>
    </a>

    <?php if($expend==1){
        echo "	
	<section class=\"products container\">
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
		<div class=\"product-card\">
			<div class=\"product-image\">
				<img src=\"https://cdn.shopify.com/s/files/1/0938/8938/products/10231100205_1_1315x1800_300_CMYK_1024x1024.jpeg?v=1445623369\">
			</div>
			<div class=\"product-info\">
				<h5>Manteau</h5>
				<h6>$99.99</h6>
			</div>
		</div>
		
	</section>
        ";
    }?>
    <a href="shop.php?expend=1" class="collection-item black-text
        <?php if($expend==2) {
        echo "grey lighten-3 active";
    } else {
        echo "grey lighten-5";
    } ?>">
        <div class="container">
            <span class="badge">14</span>
            Menu principal
        </div>
    </a>
</div>
