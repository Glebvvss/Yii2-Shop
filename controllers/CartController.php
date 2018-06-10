<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 04.05.2018
 * Time: 22:22
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Cart;
use app\models\ConfirmOrderForm;

class CartController extends Controller {

    public function actionCart() {
        Yii::$app->session->open();
        if ( empty($_SESSION['cart']) ) {
            $this->goBack();
        }
        $cart = new Cart();
        $products = $cart->getProductsFromCart();
        $confirm_order_form = new ConfirmOrderForm();
        return $this->render('cart', [
            'confirm_order_form' => $confirm_order_form,
            'products' => $products
        ]);
    }

    public function actionConfirmOrder() {
        $cart = new Cart();
        $cart->confirmOrder( Yii::$app->request->post() );
        $this->goHome();
    }

    public function actionAddToCartAjax() {
        $id_product = Yii::$app->request->get('id_product');
        $cart = new Cart();
        $cart->addToCart($id_product);
        $cart_qty = $cart->getCountProductsInCart();
        $cart_sum = $cart->getSumOfCart();
        return json_encode( [
            'cartQty' => $cart_qty,
            'cartSum' => $cart_sum
        ] );
    }

    public function actionDeleteFromCartAjax() {
        $this->layout = false;
        $id_product = Yii::$app->request->post('id_product');

        $cart = new Cart();
        $cart->removeFromCart($id_product);
        $products = $cart->getProductsFromCart();
        $cart_qty = $cart->getCountProductsInCart();
        $cart_sum = $cart->getSumOfCart();

        $confirm_order_form = new ConfirmOrderForm();
        return json_encode([
            'cartQty' => $cart_qty,
            'cartSum' => $cart_sum,

            'template' => $this->render('cart', [
                'confirm_order_form' => $confirm_order_form,
                'products' => $products
            ]),
        ]);
    }

    public function actionChangeQtyProduct() {
        $id_product = Yii::$app->request->get('id_product');
        $qty = Yii::$app->request->get('qty');

        $cart = new Cart();
        $cart->changeQtyProduct($id_product, $qty);
    }

}