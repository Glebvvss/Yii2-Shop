<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 27.05.2018
 * Time: 16:01
 */

namespace app\components;

use yii\base\Widget;
use app\models\db\Products;

class RelatedProductsWidget extends Widget {

    public $id_product;

    public function run() {
        $id_product = (int) $this->id_product;
        $products = $this->getContent( $id_product );
        return $this->getHtml($products);
    }

    private function getHtml($products) {
        ob_start();
        include 'templates for widgets/RelatedProductsTemplate.php';
        return ob_get_clean();
    }

    private function getContent( $id_product ) {
        if ( !$id_product || !is_int($id_product) ) return;

        $product_category = Products::find()->where(['id' => $id_product ])->one();
        $products = Products::find()->where(['id_category' => $product_category->id_category ])->limit(3)->all();

        if ( !$products ) return;
        return $products;
    }

}