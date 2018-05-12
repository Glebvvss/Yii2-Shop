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

class CartController extends Controller {

    public function actionCart() {
        Yii::$app->session->open();
        if ( !$_SESSION['cart'] ) {
            $this->goBack();
        }
        $cart = new Cart();
        $products = $cart->getProductsFromCart();
        return $this->render('cart', [
            'products' => $products
        ]);
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
        return json_encode( [
            'template' => $this->render('cart', ['products' => $products]),
            'cartQty' => $cart_qty,
            'cartSum' => $cart_sum
        ] );
    }

}