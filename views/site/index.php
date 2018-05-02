<?php

/* @var $this yii\web\View */

$this->title = 'E-Shop';

//print_r($products);

?>


<script>
    $(document).ready(function() {
        $('.test').hide();
    });
    //    alert('asasd');
</script>

<div class="test">
    hello world!
</div>
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
				<!--banner-->	  			
				<script>
				    // You can also use "$(window).load(function() {"
				    $(function () {
				      // Slideshow 4
				      $("#slider4").responsiveSlides({
				        auto: true,
				        pager:true,
				        nav:false,
				        speed: 500,
				        namespace: "callbacks",
				        before: function () {
				          $('.events').append("<li>before event fired.</li>");
				        },
				        after: function () {
				          $('.events').append("<li>after event fired.</li>");
				        }
				      });
				
				    });
				</script>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="shop">
			<a href="single.html">SHOP COLLECTION NOW</a>
		</div>
	</div>
</div>
<!-- content-section-starts-here -->
<div class="container">
	<div class="main-content">
		<div class="online-strip">
			<div class="col-md-4 follow-us">
				<h3>follow us : <a class="twitter" href="#"></a><a class="facebook" href="#"></a></h3>
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
			<div class="col-md-4 col-xs-12 product simpleCart_shelfItem text-center">
				<a href=""><img src="/images/product/<?=$product->img?>" alt="" /></a>
				<div class="mask">
					<a href="#">Quick View</a>
				</div>
				<a class="product_name" href=""><?=$product->name_product?></a>
				<p><a class="item_add" href="#"><i></i> <span class="item_price">$<?=$product->price?></span></a></p>
			</div>
            <?php endforeach; ?>


			<div class="clearfix"></div>
		</div>
		<!--/latest items-->
	</div>
</div>
<!--
<div class="other-products">
	<div class="container">
		<h3 class="like text-center">Featured Collection</h3>		
	    <ul id="flexiselDemo3">			    
			<li><a href="single.html"><img src="images/l1.jpg" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l2.jpg" class="img-responsive" alt="" /></a>						
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">praising pain</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l3.jpg" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">Neque porro</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l4.jpg" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">equal blame</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
				</div>
			</li>
			<li><a href="single.html"><img src="images/l5.jpg" class="img-responsive" alt="" /></a>
				<div class="product liked-product simpleCart_shelfItem">
				<a class="like_name" href="single.html">perfectly simple</a>
				<p><a class="item_add" href="#"><i></i> <span class=" item_price">$649</span></a></p>
				</div>
			</li>
	    </ul>

	    <script type="text/javascript">
			$(window).load(function() {
				$("#flexiselDemo3").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,    		
					pauseOnHover: true,
					enableResponsiveBreakpoints: true,
			    	responsiveBreakpoints: { 
			    		portrait: { 
			    			changePoint:480,
			    			visibleItems: 1
			    		}, 
			    		landscape: { 
			    			changePoint:640,
			    			visibleItems: 2
			    		},
			    		tablet: { 
			    			changePoint:768,
			    			visibleItems: 3
			    		}
			    	}
			    });				    
			});
	   </script>
	</div>
</div>-->