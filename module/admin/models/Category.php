<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 11.05.2018
 * Time: 16:12
 */

namespace app\admin\models;

use app\models\db\Categories;
use yii\helpers\ArrayHelper;

class Category {

    public function getCategories( $main_category_id = 0, $type_category_id = 0 ) {
        $main_category_id = $this->validateMainCategoryId( $main_category_id );
        $type_category_id = $this->validateTypeCategoryId( $main_category_id, $type_category_id );

        $main_category_list = $this->getMainCategoriesArray();
        $type_category_list = $this->getTypeCategoriesArray( $main_category_id );
        $category_list = $this->getCategoriesArray( $type_category_id );
        return [
            'main_category_list' => $main_category_list,
            'type_category_list' => $type_category_list,
            'category_list' => $category_list
        ];
    }

    private function getMainCategoriesArray() {
        $categories = Categories::find()->asArray()
                                        ->where(['id_parent' => 0 ])
                                        ->all();

        return ArrayHelper::map($categories, 'id', 'category');
    }

    private function getTypeCategoriesArray( $main_category_id ) {
        $categories = Categories::find()->asArray()
                                        ->where(['id_parent' => $main_category_id ])
                                        ->all();

        return ArrayHelper::map($categories, 'id', 'category');
    }

    private function getCategoriesArray( $type_category_id ) {
        $categories = Categories::find()->asArray()
                                        ->where(['id_parent' => $type_category_id ])
                                        ->all();

        if ( $categories == [] ) $categories[] = 'none';
        return ArrayHelper::map($categories, 'id', 'category');
    }

    private function validateMainCategoryId( $main_category_id ) {
        if ( !$main_category_id ) {
            $categories = Categories::find()->where(['id_parent' => 0])->one();
            return $major_category_id = $categories->id;
        }
        return $main_category_id;
    }

    private function validateTypeCategoryId( $main_category_id, $type_category_id ) {
        if ( !$type_category_id ) {
            $categories = Categories::find()->where(['id_parent' => $main_category_id])->one();
            return $parent_category_id = $categories->id;
        }
        return $type_category_id;
    }

}