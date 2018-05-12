<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 06.05.2018
 * Time: 4:56
 */

namespace app\interfaces;

interface ICart {

    public function addToCart($id_product, $qty = 1);

    public function removeFromCart($id_product);

    public function getSumOfCart();

    public function getCountProductsInCart();

}