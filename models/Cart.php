<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 05.05.2018
 * Time: 3:14
 */

namespace app\models;

use Yii;
use app\models\db\Products;
use app\interfaces\ICart;
use yii\db\Query;
use app\models\db\Orders;
use app\models\db\OrderProduct;
use yii\db\Expression;

class Cart implements ICart {

    public function __construct() {
        Yii::$app->session->open();
    }

    public function confirmOrder() {
        $order = new Orders;

        $order->id_user = Yii::$app->user->getId();
        $order->total_sum = $_SESSION['cart.sum'];
        $order->total_qty = $_SESSION['cart.qty'];
        $order->status = 'new order';
        $order->message = $_POST['message'];
        $order->date = date(date('Y-m-d'));
        $order->time = date('H:i:s');
        $order->save();

        $this->addProductsByOrder();

        unset($_SESSION['cart']);
        unset($_SESSION['cart.sum']);
        unset($_SESSION['cart.qty']);
    }

    private function addProductsByOrder() {
        $productsByOrder = Yii::$app->session->get('cart');

        if ( empty($productsByOrder) ) return;

        $id_order = $this->getIdOrder();
        foreach ( $productsByOrder as $id_product => $product ) {
            $orderProduct = new OrderProduct();
            $orderProduct->id_order = $id_order;
            $orderProduct->id_product = $id_product;
            $orderProduct->qty_product = $product['qty'];
            $orderProduct->save();
        }
    }

    private function getIdOrder() {
        $id = Orders::find()->select([
            'last_id'  => new Expression('MAX(orders.id)')
        ])->asArray()->one();
        return $id['last_id'];
    }

    public function getProductsFromCart() {
        $products = $_SESSION['cart'];
        if ( empty($products) ) return;
        foreach( $products as $id_product => $product ) {
            $sizes = $this->getSizesOfProduct($id_product);
            $products[$id_product]['sizes'] = $sizes;
        }
        return $products;
    }

    public function addToCart($id_product, $qty = 1) {
        if ( !$_SESSION['cart'][$id_product] ) {
            $this->addProductToSessionOfCart($id_product, $qty);
        } else {
            $_SESSION['cart'][$id_product]['qty'] += $qty;
        }
        $this->changeSumOfCartToUp($id_product, $qty);
        $this->changeTotalCountOfCartToUp($qty);
    }

    public function removeFromCart($id_product) {
        if ( !$_SESSION['cart'][$id_product] || empty($_SESSION['cart'][$id_product]) )  return;

        $this->changeSumOfCartToDown($id_product);
        $this->changeTotalCountOfCartToDown($id_product);
        unset( $_SESSION['cart'][$id_product] );
    }

    public function getSumOfCart() {
        return $_SESSION['cart.sum'];
    }

    public function getCountProductsInCart() {
        return $_SESSION['cart.qty'];
    }

    public function changeQtyProduct($id_product, $qty) {
        $this->removeOldQty($id_product);
        $this->addNewQty($id_product, $qty);
    }

    private function removeOldQty($id_product) {
        $qty = $_SESSION['cart'][$id_product]['qty'];
        $price = $_SESSION['cart'][$id_product]['price'];

        $_SESSION['cart.qty'] -= $qty;
        $_SESSION['cart.sum'] -= $qty * $price;
    }

    private function addNewQty($id_product, $qty) {
        $_SESSION['cart'][$id_product]['qty'] = $qty;
        $price = $_SESSION['cart'][$id_product]['price'];

        $_SESSION['cart.qty'] += $qty;
        $_SESSION['cart.sum'] += $qty * $price;
    }

    private function changeTotalCountOfCartToUp($qty) {
        if ( !$_SESSION['cart.qty'] ) {
            $_SESSION['cart.qty'] = 0;
        }
        $_SESSION['cart.qty'] += $qty;
    }

    private function changeTotalCountOfCartToDown($id_product) {
        $_SESSION['cart.qty'] -= $_SESSION['cart'][$id_product]['qty'];
    }

    private function getSizesOfProduct($id_product) {
        $query = new Query();
        return $query->select('size_product.id_product, sizes.id, sizes.size')
            ->from('size_product')
            ->join('LEFT JOIN', 'sizes', 'sizes.id = size_product.id_size')
            ->join('LEFT JOIN', 'products', 'products.id = size_product.id_product')
            ->where(['size_product.id_product' => $id_product])
            ->createCommand()
            ->queryAll();
    }

    private function addProductToSessionOfCart($id_product, $qty) {
        $product = Products::findOne(['id' => $id_product]);
        $_SESSION['cart'][$id_product] = [
            'id_product' => $product->id,
            'name_product' => $product->name_product,
            'price' => $product->price,
            'img' => $product->img,
            'qty' => $qty
        ];
    }

    private function changeSumOfCartToDown($id_product) {
        $sum_of_product = $_SESSION['cart'][$id_product]['price'] * $_SESSION['cart'][$id_product]['qty'];
        $_SESSION['cart.sum'] -= $sum_of_product;
    }

    private function changeSumOfCartToUp($id_product, $qty) {
        if ( !$_SESSION['cart.sum'] ) {
            $_SESSION['cart.sum'] = 0;
        }
        $_SESSION['cart.sum'] += $_SESSION['cart'][$id_product]['price'] * $qty;
    }

}