<?php
    $this->title = 'E-SHOP | ' . $product->name_product;
?>

<div class="container">
    <div class="products-page">
        <div class="products">

            <!-- Sidebar widget -->
            <?= app\components\SidebarWidget::widget() ?>

            <!-- Tags widget -->
            <?= app\components\TagsWidget::widget(['id_product' => $id_product]) ?>

        </div>



        <div class="new-product">
            <div class="col-md-5 zoom-grid">
                <img src="/images/product/<?=$product->img?>" style="width: 100%;" data-imagezoom="true" class="img-responsive" alt="" />
            </div>
            <div class="col-md-7 dress-info">
                <div class="dress-name">
                    <h3><?=$product->name_product?></h3>
                    <span>$<?=$product->price?></span>
                    <div class="clearfix"></div>
                    <p><?=nl2br($product->about)?></p>
                </div>
                <div class="span span1">
                    <p class="left">BRAND</p>
                    <p class="right"><?=$product->brands->brand?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="span span2">
                    <p class="left">MADE IN</p>
                    <p class="right"><?=$product->countries->country?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="span span3">
                    <p class="left">COLOR</p>
                    <p class="right"><?=$product->color?></p>
                    <div class="clearfix"></div>
                </div>
                <div class="span span4">
                    <p class="left">SIZE</p>
                    <p class="right"><span class="selection-box"><select class="domains valid" name="domains">
                                        <?php foreach($sizes as $size) : ?>
										   <option><?=$size['sizes'][0]['size']?></option>
                                        <?php endforeach; ?>
									   </select></span></p>
                    <div class="clearfix"></div>
                </div>
                <div class="purchase">
                    <a href="#">Purchase Now</a>
                    <div class="social-icons">
                        <ul>
                            <li><a class="facebook1" href="#"></a></li>
                            <li><a class="twitter1" href="#"></a></li>
                            <li><a class="googleplus1" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="reviews-tabs">
                <!-- Main component for a primary marketing message or call to action -->
                <ul class="nav nav-tabs responsive hidden-xs hidden-sm" id="myTab">
                    <li class="test-class active"><a class="deco-none misc-class" data-toggle="tab" href="#more-information"> More Information</a></li>
                    <li class="test-class"><a href="#features" data-toggle="tab">Specifications</a></li>
                    <li class="test-class"><a class="deco-none" href="#reviews" data-toggle="tab">Reviews (7)</a></li>
                </ul>

                <div class="tab-content responsive hidden-xs hidden-sm">

                    <div class="tab-pane active" id="more-information">
                        <p class="tab-text"><?=nl2br($product->about_large)?></p>
                    </div>

                    <div class="tab-pane" id="features">
                        <p class="tab-text"><?=nl2br($product->specifications)?></p>
                    </div>

                    <div class="tab-pane" id="reviews">
                        <div class="response">



                            <?= app\components\ReviewWidget::widget(['id_product' => $id_product]); ?>



                        </div>
                    </div>

                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>
    <div class="clearfix"></div>
    </div>

<div class="other-products products-grid">
    <div class="container">
        <header>
            <h3 class="like text-center">Related Products</h3>
        </header>
        <div class="col-md-4 product simpleCart_shelfItem text-center">
            <a href="single.html"><img src="images/p1.jpg" alt="" /></a>
            <div class="mask">
                <a href="single.html">Quick View</a>
            </div>
            <a class="product_name" href="single.html">Sed ut perspiciatis</a>
            <p><a class="item_add" href="#"><i></i> <span class="item_price">$329</span></a></p>
        </div>
        <div class="col-md-4 product simpleCart_shelfItem text-center">
            <a href="single.html"><img src="images/p2.jpg" alt="" /></a>
            <div class="mask">
                <a href="single.html">Quick View</a>
            </div>
            <a class="product_name" href="single.html">great explorer</a>
            <p><a class="item_add" href="#"><i></i> <span class="item_price">$599.8</span></a></p>
        </div>
        <div class="col-md-4 product simpleCart_shelfItem text-center">
            <a href="single.html"><img src="images/p3.jpg" alt="" /></a>
            <div class="mask">
                <a href="single.html">Quick View</a>
            </div>
            <a class="product_name" href="single.html">similique sunt</a>
            <p><a class="item_add" href="#"><i></i> <span class="item_price">$359.6</span></a></p>
        </div>
        <div class="clearfix"></div>
    </div>
</div>



