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

    public function addCategory( $category, $id_parent = null ) {
        if ( !$id_parent ) $id_parent = 0;

        $categories = new Categories();
        $categories->category = $category;
        $categories->id_parent = $id_parent;
        $categories->save();
    }

    public function deleteCategory( $id_category ) {
        $category_list = $this->getCategoryWithChildren( $id_category );

        Products::updateAll(['id_category' => NULL], ['id_category' => $category_list]);
        Categories::find()->where(['id' => $category_list])->one()->delete();
    }

    public function getParentsOfCategoryById( $id_category ) {
        $parents_id['category'] = $id_category;

        $type_category_id = $this->getParentOfCategory( $id_category );
        $parents_id['typeCategory'] = $type_category_id;

        $main_category_id = $this->getParentOfCategory( $type_category_id );
        $parents_id['mainCategory'] = $main_category_id;

        return $parents_id;
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

    private function getParentOfCategory( $id_category ) {
        $row_category = Categories::find()->select('id_parent')
            ->where(['id' => $id_category])
            ->one();

        return $row_category->id_parent;
    }

}