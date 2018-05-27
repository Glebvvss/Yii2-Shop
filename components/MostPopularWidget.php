<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 28.05.2018
 * Time: 0:37
 */

namespace app\components;

use yii\base\Widget;
use app\models\db\Products;

class MostPopularWidget extends Widget {

    public function run() {
        $products = $this->getContent();
        return $this->getHtml($products);
    }

    private function getContent() {
        return Products::find()->limit(5)
                               ->orderBy(['sales' => SORT_DESC])
                               ->all();
    }

    private function getHtml($products) {
        ob_start();
        include 'templates for widgets/MostPopularTemplate.php';
        return ob_get_clean();
    }

}