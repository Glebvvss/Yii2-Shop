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
        $subquery = $this->getSubquery($id_category);
        return Categories::find()
            ->where(['id_parent' => $subquery['id_parent']])
            ->all();
    }

    private function getSubquery(int $id_category) {
        return Categories::find()
            ->select('id_parent')
            ->where(['id' => $id_category])
            ->asArray()
            ->one();
    }

}