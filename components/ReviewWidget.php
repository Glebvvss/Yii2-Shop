<?php

namespace app\components;

use yii\base\Widget;
use app\traits\TBuildTree;
use app\models\db\Reviews;

class ReviewWidget extends Widget {

    use TBuildTree;

    public $id_product;

    public function run() {
        $reviews = $this->getReviews();
        $tree_reviews = $this->buildTreeReviews($reviews);
        $tpl = $this->getHtml($tree_reviews);
        return $tpl;
    }

    private function getHtml($tree_reviews) {
        ob_start();
        include 'templates for widgets/ReviewTemplate.php';
        return ob_get_clean();
    }

    private function buildTreeReviews($reviews) {
        return $this->setNameSubnodes('subreviews')
                    ->buildTreeArray($reviews);
    }

    private function getReviews() {
        return Reviews::find()->where(['id_product' => $this->id_product])
                              ->indexBy('id')
                              ->asArray()
                              ->all();
    }

}