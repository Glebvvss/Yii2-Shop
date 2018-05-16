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
use app\models\SearchChildrenOfNodes;

class Category {

    private $category_tree;

    public function addCategory( $category, $id_parent ) {
        $category_in_db = Categories::findOne(['id' => $id_parent, 'category' => $category]);
        if ( $category_in_db ) return;

        $categories = new Categories();
        $categories->categories = $category;
        $categories->id_parent = $id_parent;
        $categories->save();
    }

    public function deleteCategory( $id_category ) {
        $tree = Categories::find()->asArray()->all();
        $search_children_nodes = new SearchChildrenOfNodes();
        $children_list = $search_children_nodes->getChildrenNodesList($tree, $id_category);

        debug($children_list);

/*
        //проверить данные кода
        if ( $children_list ) {
            Categories::find()->where(['id' => $id_category])->one()->delete();
        } else {
            Categories::find()->where(['id' => $id_category])->one()->delete();
        }
        //проверить данные кода
*/
    }

    public function addProductCategory( $category, $main_category_id ) {
        $categories = new Categories();

    }

    public function getParentsOfCategoryById( $id_category ) {
        $this->category_tree['category_id'] = $id_category;
        $type_category_id = $this->getParentOfCategory( $id_category );
        $this->category_tree['type_category_id'] = $type_category_id;
        $main_category_id = $this->getParentOfCategory( $type_category_id );
        $this->category_tree['main_category_id'] = $main_category_id;

        return $this->category_tree;
    }

    private function getParentOfCategory( $id_category ) {
        $row_category = Categories::find()->select('id_parent')
                                          ->where(['id' => $id_category])
                                          ->one();

        return $row_category->id_parent;
    }

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