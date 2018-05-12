<?php

namespace app\components;

use yii\base\Widget;
use app\traits\TBuildTree;
use app\models\db\Reviews;

class ReviewWidget extends Widget {

    use TBuildTree;

    public $id_product;
    public $reviews;

    public function run() {
        $tree_reviews = $this->buildTreeReviews();
        $tpl = $this->getHtml($tree_reviews);
        return $tpl;
    }

    private function getHtml($tree_reviews) {
        ob_start();
        include 'templates for widgets/ReviewTemplate.php';
        return ob_get_clean();
    }

    private function buildTreeReviews() {
        return $this->setNameSubnodes('subreviews')
                    ->buildTreeArray($this->reviews);
    }

}