<?php

namespace app\models;

use app\interfaces\IGetProducts;
use app\models\builders\GetProductsBuilder;
use yii\db\Query;
use app\models\db\Categories;
use app\traits\TBuildTree;
use app\traits\TCheckChildrenOfCategory;

class GetProducts implements IGetProducts {

    use TBuildTree;
    use TCheckChildrenOfCategory;

    private $sort_direction;
    private $id_category;
    private $sort_type;
    private $tag;

    public function __construct( GetProductsBuilder $builder ) {
        $this->sort_direction = $builder->sort_direction;
        $this->id_category = $builder->id_category;
        $this->sort_type = $builder->sort_type;
        $this->tag = $builder->tag;
    }

    public function getProducts() {
        if ( $this->tag ) {
            $query = $this->selectProductsByTag();
        } elseif ( $this->id_category ) {
            $query = $this->selectProductsOfCategory();
        } else {
            $query = $this->selectProductsFromAll();
        }
        return $this->sortProducts($query);
    }

    private function selectProductsByTag() {
        $query = new Query();
        return $query->select('*')
                     ->from('tag_product')
                     ->join('LEFT JOIN', 'tags', 'tags.id = tag_product.id_tag')
                     ->join('LEFT JOIN', 'products', 'products.id = tag_product.id_tag')
                     ->where(['tags.tag' => $this->tag]);
    }

    private function selectProductsOfCategory() {
        $haveChildren = $this->checkForChildrenOfCategory($this->id_category);
        if ( $haveChildren === true ) {
            return $this->selectProductsFromCategoryWithChildren();
        }
        return $this->selectProductsFromCategoryWithoutChildren();
    }

    private function selectProductsFromCategoryWithoutChildren() {
        $query = new Query();
        return $query->select('*')
            ->from('products')
            ->where(['id_category' => $this->id_category]);
    }

    private function selectProductsFromCategoryWithChildren() {
        $tree = $this->getTreeChildrenCategories();
        $searchChildrenOfNodes = new SearchChildrenOfNodes();
        $children_category_list = $searchChildrenOfNodes->setSubnodeName('subcategories')
                                                        ->getChildrenNodesList($tree, $this->id_category);

        $query = new Query();
        return $query->select('*')
            ->from('products')
            ->where(['id_category' => $children_category_list]);
    }

    private function getTreeChildrenCategories() {
        $categories = Categories::find()->asArray()->indexBy('id')->all();
        return $this->setNameSubnodes('subcategories')
                    ->buildTreeArray($categories);
    }

    private static function selectProductsFromAll() {
        $query = new Query();
        return $query->select('*')
                     ->from('products');
    }

    private function sortProducts($query) {
        $sort_direction = $this->setSortDirection();
        try {
            if ( $this->sort_type == 'position' ) {
                return $query->orderBy(['products.id' => $sort_direction]);
            }
            if ( $this->sort_type == 'name' ) {
                return $query->orderBy(['products.name_product' => $sort_direction]);
            }
            if ( $this->sort_type == 'price' ) {
                return $query->orderBy(['products.price' => $sort_direction]);
            }
                throw new Exception('could not found type of sort');
        } catch(Exception $e) {
            return $query->orderBy(['id' => $sort_direction]);
        }
    }

    private function setSortDirection() {
        if ( $this->sort_direction == 'ASC' ) {
            return SORT_ASC;
        }
        return SORT_DESC;
    }

}