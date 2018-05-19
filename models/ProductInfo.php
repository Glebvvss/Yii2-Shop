<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 03.05.2018
 * Time: 19:45
 */

namespace app\models;

use app\models\db\SizeProduct;
use app\models\db\Products;

class ProductInfo {

    public static function getInfo($id_product) {
        $product_info = self::getProductInfoWithoutSizesInfo($id_product);
        $sizes = self::getSizes($id_product);
        $product_info['sizes'] = $sizes;
        return $product_info;
    }

    private static function getSizes($id_product) {
        return SizeProduct::find()
                ->where(['id_product' => $id_product])
                ->joinWith('products')
                ->joinWith('sizes')
                ->asArray()
                ->all();
    }

    private static function getProductInfoWithoutSizesInfo($id_product) {
        return Products::find()
                ->where(['products.id' => $id_product])
                ->joinWith('countries')
                ->joinWith('brands')
                ->asArray()
                ->one();
    }

}