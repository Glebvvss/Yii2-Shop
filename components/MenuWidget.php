<?php

namespace app\components;

use yii\base\Widget;
use app\traits\TBuildTree;
use app\models\db\Categories;

class MenuWidget extends Widget {

    use TBuildTree;

    public function run() {
        $categoriesList = Categories::find()
            ->indexBy('id')
            ->asArray()
            ->all();

        $menu = $this->setNameSubnodes('subcategories')->buildTreeArray($categoriesList);
        $tpl = $this->getHtml($menu);
        return $tpl;
    }

    private function getHtml(array $menu) {
        ob_start();
        include 'templates for widgets/MenuTemplate.php';
        return ob_get_clean();
    }

}