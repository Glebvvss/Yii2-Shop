<div class="other-products">
    <div class="container">
        <h3 class="like text-center">Most Popular</h3>
        <ul id="flexiselDemo3">
            <? foreach ( $products as $product ) : ?>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>"><img src="/web/images/product/<?= $product->img ?>" class="img-responsive" alt="" /></a>
                <div class="product liked-product simpleCart_shelfItem">
                    <a class="like_name" href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>"><?= $product->name_product ?></a>
                    <p onmousedown="return false" class="add-to-cart" style="cursor: pointer;" id="to-cart-<?= $product->id ?>"><i></i> <span class="item_price">$<?= sprintf("%.2f", $product->price/100);  ?></span></p>
                </div>
            </li>
            <? endforeach; ?>
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
</div>