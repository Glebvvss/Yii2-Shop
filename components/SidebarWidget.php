<?php

namespace app\components;

use yii\base\Widget;
use app\models\db\Categories;

class SidebarWidget extends Widget {

    public function run() {
        $categories = $this->categoriesOfSidebar();
        $tpl = $this->getHtml($categories);
        return $tpl;
    }

    private function categoriesOfSidebar() {
        $id_parent = Categories::find()->where(['id' => $_GET['id_category']])->all();

        if ( !$id_parent ) {
            return Categories::find()->where(['id_parent' => 0])->all();
        }
        return Categories::find()->where(['id_parent' => $id_parent])->all();
    }

    private function getHtml($categories) {
        ob_start();
        include 'templates for widgets/SidebarTemplate.php';
        return ob_get_clean();
    }

}