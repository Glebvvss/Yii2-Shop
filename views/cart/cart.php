<?
    $this->title = 'E-Shop | Cart';
    use yii\widgets\ActiveForm;
?>


<div class="cart-items" id="ajax-update-cart">
    <div class="container">
        <div class="dreamcrub">
            <ul class="breadcrumbs">
                <li class="home">
                    <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" title="Go to Home Page">Home</a>&nbsp;
                    <span>&gt;</span>
                </li>
                <li class="women">
                    Cart
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <h2>MY SHOPPING BAG (<?= count( $_SESSION['cart'] ) ?>)</h2>

        <div class="cart-gd">
            <? if ( !empty($products) ) : ?>
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
                                <li><p>Min. order value: <input class="cart-qty-input" product="<?= $product['id_product'] ?>" value="<?= $product['qty'] ?>"></p></li>
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

            <div class="confirm-order-btn">
                <a href="" class="btn" id="open-modal-order-page">Confirm Order</a>
            </div>
        </div>
    </div>
</div>



<div id="modal-confirm-order">
    <? if ( !Yii::$app->user->isGuest ) : ?>

        <div id="modal-order-user">
            <? $f = ActiveForm::begin([
                    'action' => Yii::$app->urlManager->createUrl('cart/confirm-order')
            ]); ?>
            <p>In the follow field you can write your address and other information for the administrator, who call you soon after confirm order.</p>
            <div class="row">
                <div class="col-md-12" style="margin-top: 15px;"><?= $f->field($confirm_order_form, 'message')->textArea(['rows' => 4])->label(false) ?></div>
                <div class="col-md-12">
                    <div class="parent-flex">
                        <button class="button-confirm-order btn btn-sm" type="submit">Confirm Order</button>
                    </div>
                </div>
            </div>
            <? ActiveForm::end(); ?>
        </div>

    <? else: ?>

        <div id="modal-order-guest">
            <? $f = ActiveForm::begin([
                'action' => Yii::$app->urlManager->createUrl('cart/confirm-order')
            ]); ?>
            <p>In the follow form you can write your address and other information for the administrator, who call you soon after confirm order.</p>
            <div class="row">
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'first_name') ?></div>
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'last_name') ?></div>
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'mobile_phone') ?></div>
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'email') ?></div>
                <div class="col-md-12"><?= $f->field($confirm_order_form, 'message')->textArea(['row' => 4]) ?></div>
                <div class="col-md-12">
                    <div class="parent-flex">
                        <button class="button-confirm-order btn btn-sm" type="submit">Confirm Order</button>
                    </div>
                </div>
            </div>
            <? ActiveForm::end(); ?>
        </div>

    <? endif; ?>
</div>
<div id="overlay"></div>