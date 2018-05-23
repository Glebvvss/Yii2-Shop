<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 11.05.2018
 * Time: 16:12
 */

namespace app\admin\models;

use app\models\db\Categories;
use app\models\db\Products;
use yii\helpers\ArrayHelper;
use app\traits\TBuildTree;
use app\traits\TCheckChildrenOfCategory;
use app\models\SearchChildrenOfNodes;
use app\admin\interfaces\ICategoryCRUD;

class CategoryCRUD implements ICategoryCRUD {

    use TBuildTree;
    use TCheckChildrenOfCategory;

    public function addCategory( $category, $id_parent ) {
        if ( !$id_parent ) $id_parent = 0;
        if ( !$this->validateCategoryForAdd( $category, $id_parent ) ) return;

        $categories = new Categories();
        $categories->category = $category;
        $categories->id_parent = $id_parent;
        $categories->save();
    }

    public function deleteCategory( $id_category, $delete_products_by_category ) {
        $category_list = $this->getCategoryWithChildren( $id_category );
        Categories::find()->where(['id' => $category_list])->one()->delete();

        if ( $delete_products_by_category ) {
            Products::find()->where(['id_category' => $category_list])->all()->delete();
        }
    }

    private function getCategoryWithChildren( $id_category ) {
        $categories = Categories::find()->asArray()
                                        ->indexBy('id')
                                        ->all();

        if ( !$this->checkForChildrenOfCategory($id_category) ) {
            return $id_category;
        }

        $tree = $this->buildTreeArray($categories);
        $searchChildrenOfNodes = new SearchChildrenOfNodes();
        $children_list = $searchChildrenOfNodes->getChildrenNodesList($tree, $id_category);
        $children_list[] = $id_category;
        return $children_list;
    }

    public function getParentsOfCategoryById( $id_category ) {
        $parents_id['category'] = $id_category;

        $type_category_id = $this->getParentOfCategory( $id_category );
        $parents_id['typeCategory'] = $type_category_id;

        $main_category_id = $this->getParentOfCategory( $type_category_id );
        $parents_id['mainCategory'] = $main_category_id;

        return $parents_id;
    }

    private function getParentOfCategory( $id_category ) {
        $row_category = Categories::find()->select('id_parent')
            ->where(['id' => $id_category])
            ->one();

        return $row_category->id_parent;
    }

    private function validateCategoryForAdd( $category, $id_parent ) {
        $category_in_db = Categories::findOne(['id' => $id_parent, 'category' => $category]);
        if ( $category_in_db ) {
            return false;
        }
        return true;
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