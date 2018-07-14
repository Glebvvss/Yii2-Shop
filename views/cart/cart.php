<?
    $this->title = 'E-Shop | Cart';
    use yii\widgets\ActiveForm;
?>

<div class="cart-items" id="ajax-update-cart">
    <div class="container">
        <h2>MY SHOPPING BAG (<span class="count-of-cart"><?= $_SESSION['cart.qty'] ?></span>)</h2>
        <div class="cart-gd">
            <? if ( !empty($products) ) : ?>
            <div class="col-md-12" style="margin-left: 0px;">
                <? foreach ( $products as $id => $product ) : ?>
                <div class="col-md-6 item-cart-block">
                    <div class="position-block">
                        <div class="close1 remove-position remove" id="product-<?= $id ?>"> </div>
                        <div>
                            <div class="col-md-3 col-sm-3 col-xs-4 left-img">
                                <img src="/web/images/product/<?= $product['img'] ?>" class="cart-image"><!--  -->
                            </div>

                            <div class="col-md-9 col-sm-9 col-xs-8 description-pos">
                               <div class="normallize">
                                    <div style="padding-left: 2px;">
                                        <h3><a class="name-product-in-cart" href="#"><?= $product['name_product'] ?></a></h3>
                                    </div>
                                    <ul class="list">
                                        <li><p>Min. order value: <input class="cart-qty-input" product="<?= $product['id_product'] ?>" value="<?= $product['qty'] ?>"></p></li>
                                        <li>
                                            <div class="inline-size-block">
                                                <div>Sizes of product: </div>
                                                <div style="width: inherit;">
                                                    <select class="test-test select-size" id="<?= $id_product ?>">
                                                        <? foreach( $product['sizes'] as $size ) : ?>
                                                        <option value="<?= $size['size'] ?>"><?= $size['size'] ?></option>
                                                        <? endforeach; ?>
                                                    </select>                                            
                                                </div>
                                            </div>
                                        </li>
                                        <li class="price-indentation">Price : $<?= sprintf("%.2f", $product['price']/100); ?></li>
                                    </ul>
                               </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>
            </div>
            <? endif; ?>
            <div class="confirm-order-btn">
                <a href="" class="btn" id="open-modal-order-page">Confirm Order</a>
            </div>
        </div>
    </div>
</div>


<div id="modal-confirm-order" class="order-modal">
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
                        <button class="button-confirm-order btn btn-sm" type="submit" style="margin-left: 5px;">Confirm Order</button>
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
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'mobile_phone')->label('Mobile Phone*') ?></div>
                <div class="col-md-6"><?= $f->field($confirm_order_form, 'email')->label('Email*') ?></div>
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
