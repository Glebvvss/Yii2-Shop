<?php
    $this->title = 'E-SHOP | Categories';
?>

<div>
    <div class="container">
        <div class="products-page">
            <div class="products">

                <!-- Sidebar widget -->
                <?= app\components\SidebarWidget::widget() ?>

                <!-- Tags widget -->
                <?= app\components\TagsWidget::widget(['id_category' => $id_category]) ?>

            </div>

            <div class="new-product">
                <div id="update" data-id="<?= $id_category ?>">
                    <div class="new-product-top">
                        <ul class="product-top-list">
                            <li><a href="index.html">Home</a>&nbsp;<span>&gt;</span></li>
                            <li><span class="act">Best Sales</span>&nbsp;</li>
                        </ul>
                        <p class="back"><a href="index.html">Back to Previous</a></p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mens-toolbar">
                        <div class="sort">
                            <div class="sort-by">
                                <label>Sort By</label>
                                <select class="ajax-update" id="sort-type">
                                    <option value="position" <?php if($sort_type == 'position') echo 'selected' ?>>
                                        Position            </option>
                                    <option value="name" <?php if($sort_type == 'name') echo 'selected' ?>>
                                        Name                </option>
                                    <option value="price" <?php if($sort_type == 'price') echo 'selected' ?>>
                                        Price               </option>
                                </select>

                                <? if( $sort_direction == 'DESC' || !$sort_direction ) : ?>
                                    <i class="fas fa-angle-up" style="cursor: pointer" id="sort-direction"  data-id="DESC"></i>
                                <? else : ?>
                                    <i class="fas fa-angle-down" style="cursor: pointer" id="sort-direction" data-id="ASC"></i>
                                <? endif; ?>
                            </div>
                        </div>

                        <ul class="women_pagenation">
                            <li>Page:</li>
                            <li>
                                <?php
                                     echo yii\widgets\LinkPager::widget([
                                        'pagination' => $pages,
                                         'options' => ['class' => '']
                                     ]);
                                ?>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

                        <div class="cbp-vm-options">
                            <a href="#" class="cbp-vm-icon cbp-vm-grid cbp-vm-selected" data-view="cbp-vm-view-grid" title="grid">Grid View</a>
                            <a href="#" class="cbp-vm-icon cbp-vm-list" data-view="cbp-vm-view-list" title="list">List View</a>
                        </div>

                        <div class="pages">
                            <div class="limiter visible-desktop">
                                <label>Show</label>
                                <select class="ajax-update" id="products-per-page">
                                    <option value="9" selected="selected">
                                        9                </option>
                                    <option value="15">
                                        15                </option>
                                    <option value="30">
                                        30                </option>
                                </select> per page
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>



                        <div>
                            <?php foreach($products as $product) : ?>
                            <div class="col-md-4">
                                <a class="cbp-vm-image" href="<?=Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product['id']])?>">
                                    <div class="simpleCart_shelfItem">
                                        <div class="view view-first">
                                            <div class="inner_content clearfix">
                                                <div class="product_image">
                                                    <img src="/images/product/<?=$product['img']?>" style="width: 100%;" class="img-responsive" alt=""/>
                                                    <div class="mask">
                                                        <div class="info">Quick View</div>
                                                    </div>
                                                    <div class="product_container">
                                                        <div class="cart-left">
                                                            <p class="title"><?=$product['name_product']?></p>
                                                        </div>
                                                        <div class="pricey"><span class="item_price">$<?=$product['price']?></span></div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="cbp-vm-details">
                                    <?=$product['about']?>
                                </div>
                                <div class="down-block">
                                    <div class="button-cart">
                                        <a class="cbp-vm-icon cbp-vm-add item_add" href="#">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>




                        <style>
                            .down-block {
                                display: flex;
                                margin-bottom: 20px;
                            }

                            .button-cart {
                                margin: auto;
                            }
                        </style>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="other-products">
        <!--
        <div class="container">
            <h3 class="like text-center">Featured Collection</h3>
            <ul id="flexiselDemo3">
                <li><a href="single.html"><img src="images/l1.jpg" class="img-responsive"/></a>
                    <div class="product liked-product simpleCart_shelfItem">
                        <a class="like_name" href="single.html">Perfectly simple</a>
                        <p><a class="item_add" href="#"><i></i> <span class=" item_price">$759</span></a></p>
                    </div>
                </li>
                <li><a href="single.html"><img src="images/l2.jpg" class="img-responsive"/></a>
                    <div class="product liked-product simpleCart_shelfItem">
                        <a class="like_name" href="single.html">Praising pain</a>
                        <p><a class="item_add" href="#"><i></i> <span class=" item_price">$699</span></a></p>
                    </div>
                </li>
                <li><a href="single.html"><img src="images/l3.jpg" class="img-responsive"/></a>
                    <div class="product liked-product simpleCart_shelfItem">
                        <a class="like_name" href="single.html">Neque porro</a>
                        <p><a class="item_add" href="#"><i></i> <span class=" item_price">$329</span></a></p>
                    </div>
                </li>
                <li><a href="single.html"><img src="images/l4.jpg" class="img-responsive"/></a>
                    <div class="product liked-product simpleCart_shelfItem">
                        <a class="like_name" href="single.html">Equal blame</a>
                        <p><a class="item_add" href="#"><i></i> <span class=" item_price">$499</span></a></p>
                    </div>
                </li>
                <li><a href="single.html"><img src="images/l5.jpg" class="img-responsive"/></a>
                    <div class="product liked-product simpleCart_shelfItem">
                        <a class="like_name" href="single.html">Perfectly simple</a>
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
            <script type="text/javascript" src="js/jquery.flexisel.js"></script>

            -->
        </div>
    </div>
</div>