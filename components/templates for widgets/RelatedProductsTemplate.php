<div class="other-products products-grid">
    <div class="container">
        <header>
            <h3 class="like text-center">Related Products</h3>
        </header>

        <? foreach( $products as $product ) : ?>
        <div class="col-md-4 product simpleCart_shelfItem text-center">
            <a href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>"><img src="/web/images/product/<?= $product->img ?>" alt="" /></a>
            <div class="mask">
                <a href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>">Quick View</a>
            </div>
            <a class="product_name" href="<?= Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product->id]) ?>"><?= $product->name_product ?></a>
            <p><a class="item_add" href="#"><i></i> <span class="item_price">$<?= sprintf("%.2f", $product->price/100); ?></span></a></p>
        </div>
        <? endforeach; ?>

        <div class="clearfix"></div>
    </div>
</div>