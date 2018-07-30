<?php

/* @var $this yii\web\View */

$this->title = 'E-Shop';

?>

<div class="banner">
	<div class="container">
		<div class="banner-bottom">
			<div class="banner-bottom-left"><h2>B<br>U<br>Y</h2></div>
			<div class="banner-bottom-right">
				<div  class="callbacks_container">
					<ul class="rslides" id="slider4">
						<li>
							<div class="banner-info">
								<h3>Smart But Casual</h3>
								<p>Start your shopping here...</p>
							</div>
						</li>
						<li>
							<div class="banner-info">
							   <h3>Shop Online</h3>
								<p>Start your shopping here...</p>
							</div>
						</li>
						<li>
							<div class="banner-info">
							  <h3>Pack your Bag</h3>
								<p>Start your shopping here...</p>
							</div>								
						</li>
					</ul>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="shop">
			<a href="<?= Yii::$app->urlManager->createUrl('shop/products') ?>">SHOP COLLECTION NOW</a>
		</div>
	</div>
</div>
<!-- content-section-starts-here -->
<div class="container">
	<div class="main-content">
		<div class="online-strip">
			<div class="col-md-4 follow-us">
				<h3>follow us : <a class="twitter" href="https://twitter.com/"></a><a class="facebook" href="https://www.facebook.com"></a></h3>
			</div>
			<div class="col-md-4 shipping-grid">
				<div class="shipping">
					<img src="/images/shipping.png" alt="" />
				</div>
				<div class="shipping-text">
					<h3>Free Shipping</h3>
					<p>on orders over $ 199</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-md-4 online-order">
				<p>Order online</p>
				<h3>Tel:999 4567 8902</h3>
			</div>
			<div class="clearfix"></div>
		</div>

		<!--latest items-->
		<div class="products-grid">
			<header>
				<h3 class="head text-center">Latest Products</h3>
			</header>
      <?php foreach($products as $product) : ?>
			<div class="col-md-4 col-sm-6 product simpleCart_shelfItem text-center">
				<img src="/images/product/<?=$product->img?>" alt="" />
				<div class="mask">
					<a href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>">Quick View</a>
				</div>
				<a class="product_name" href=""><?=$product->name_product?></a>
				<p onmousedown="return false" class="add-to-cart" style="cursor: pointer;" id="to-cart-<?= $product->id ?>"><i></i> <span class="item_price">$<?= sprintf("%.2f", $product->price/100);  ?></span></p>
			</div>
      <?php endforeach; ?>
			<div class="clearfix"></div>
		</div>
		<!--/latest items-->
	</div>
</div>

<?= app\components\MostPopularWidget::widget(); ?>
