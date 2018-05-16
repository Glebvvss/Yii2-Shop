<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 01.05.2018
 * Time: 20:53
 */

namespace app\traits;

use app\models\db\Categories;

trait TCheckChildrenOfCategory {

    protected function checkForChildrenOfCategory($id_category) {
        $category_children = Categories::find()->where(['id_parent' => $id_category])->all();
        if ( $category_children ) {
            return true;
        }
        return false;
    }

}