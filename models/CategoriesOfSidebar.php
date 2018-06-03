<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 01.04.2018
 * Time: 20:51
 */

namespace app\models;

use app\models\db\Categories;
use app\interfaces\ICategoriesOfSidebar;

class CategoriesOfSidebar implements ICategoriesOfSidebar {

    public function getCategories(int $id_category) {
        $id_parent = $this->getParentCategoryId($id_category);
        return Categories::find()
            ->where(['id_parent' => $id_parent])
            ->all();
    }

    private function getParentCategoryId(int $id_category) {
        $category = Categories::find()
            ->select('id_parent')
            ->where(['id' => $id_category])
            ->asArray()
            ->one();

        return $category['id_parent'];
    }

}