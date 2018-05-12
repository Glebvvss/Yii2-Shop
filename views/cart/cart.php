<div class="cart-items" id="ajax-update-cart">
    <div class="container">
        <div class="dreamcrub">
            <ul class="breadcrumbs">
                <li class="home">
                    <a href="index.html" title="Go to Home Page">Home</a>&nbsp;
                    <span>&gt;</span>
                </li>
                <li class="women">
                    Cart
                </li>
            </ul>
            <ul class="previous">
                <li><a href="index.html">Back to Previous Page</a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <h2>MY SHOPPING BAG (<?= count( $_SESSION['cart'] ) ?>)</h2>

        <div class="cart-gd">
            <? if ( $products ) : ?>
                <? foreach ( $products as $id => $product ) : ?>
                <div class="cart-header">
                    <div class="close1 remove-position" id="product-<?= $id ?>"> </div>
                    <div class="cart-sec simpleCart_shelfItem">
                        <div class="test">
                            <img src="/web/images/product/<?= $product['img'] ?>" class="cart-image" alt="">
                        </div>

                        <div class="cart-item-info">
                            <div class="name-product-caption">
                                <h3><a href="#"><?= $product['name_product'] ?></a><span>Pickup time:</span></h3>
                            </div>
                            <ul class="qty">
                                <li><p>Min. order value: <input class="cart-qty-input" value="<?= $product['qty'] ?>"></p></li>
                                <li>
                                    <p>Sizes of product:
                                        <select class="test-test" id="<?= $id_product ?>">
                                            <? foreach( $product['sizes'] as $size ) : ?>
                                            <option value="<?= $size['size'] ?>"><?= $size['size'] ?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </p>
                                </li>
                            </ul>
                            <div class="">
                                <div class="cart-price">Price : $<?= sprintf("%.2f", $product['price']/100); ?></div>
                                <!--<span>Delivered in 1-1:30 hours</span>-->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <? endforeach; ?>
            <? endif; ?>
        </div>
    </div>
</div>