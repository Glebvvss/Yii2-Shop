<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 28.04.2018
 * Time: 20:34
 */

namespace app\components;

use yii\base\Widget;
use yii\db\Query;
use app\models\SearchChildrenOfNodes;
use app\traits\TCheckChildrenOfCategory;
use app\traits\TBuildTree;
use app\models\db\Categories;

class TagsWidget extends Widget {

    use TCheckChildrenOfCategory;
    use TBuildTree;

    public $id_category;
    public $id_product;

    public function run() {
        $tag_list = $this->getTagList();
        $tpl = $this->getHtml($tag_list);
        return $tpl;
    }

    private function getTagList() {
        $tag_list = [];

        $rows = $this->selectTagsSqlQuery();
        foreach ( $rows as $row ) {
            $tag_list[] = $row['tag'];
        }

        return array_unique($tag_list);//deleted duplicate tags
    }

    private function selectTagsSqlQuery() {
        if ( $this->id_category ) {
            return $this->selectTagsSqlOfCategory();
        } elseif ( $this->id_product ) {
            return $this->selectTagsSqlOfProduct();
        }
        return $this->selectTagsSqlOfAll();
    }

    private function selectTagsSqlOfProduct() {
        $query = new Query();
        return $query->select('tags.tag')
                     ->from('tag_product')
                     ->join('LEFT JOIN', 'products', 'tag_product.id_product = products.id')
                     ->join('LEFT JOIN', 'tags', 'tag_product.id_tag = tags.id')
                     ->where(['products.id' => $this->id_product])
                     ->createCommand()
                     ->queryAll();
    }

    private function selectTagsSqlOfCategory() {
        $haveChildren = $this->checkForChildrenOfCategory($this->id_category);
        if ( $haveChildren == true ) {
            return $this->selectFromCategoryWithChildren();
        }
        return $this->selectFromCategoryWithoutChildren();
    }

    private function getChildrenCategories() {
        $categories = Categories::find()->asArray()->indexBy('id')->all();
        $searchChildrenOfNodes = new SearchChildrenOfNodes();
        $tree = $this->buildTreeArray($categories);
        $node = $searchChildrenOfNodes->getChildrenNodesList($tree, $this->id_category);

        return $node;
    }

    private function selectFromCategoryWithChildren() {
        $children_categories = $this->getChildrenCategories();

        $query = new Query();
        return $query->select('tags.tag')
                     ->from('tag_product')
                     ->join('LEFT JOIN', 'products', 'tag_product.id_product = products.id')
                     ->join('LEFT JOIN', 'tags', 'tag_product.id_tag = tags.id')
                     ->where(['products.id_category' => $children_categories])
                     ->createCommand()
                     ->queryAll();
    }

    private function selectFromCategoryWithoutChildren() {
        $query = new Query();
        return $query->select('tags.tag')
                     ->from('tag_product')
                     ->join('LEFT JOIN', 'products', 'tag_product.id_product = products.id')
                     ->join('LEFT JOIN', 'tags', 'tag_product.id_tag = tags.id')
                     ->where(['products.id_category' => $this->id_category])
                     ->createCommand()
                     ->queryAll();
    }

    private function selectTagsSqlOfAll() {
        $query = new Query();
        return $query->select('tags.tag')
                     ->from('tag_product')
                     ->join('LEFT JOIN', 'products', 'tag_product.id_product = products.id')
                     ->join('LEFT JOIN', 'tags', 'tag_product.id_tag = tags.id')
                     ->createCommand()
                     ->queryAll();
    }

    private function getHtml($tag_list) {
        ob_start();
        include 'templates for widgets/TagsTemplate.php';
        return ob_get_clean();
    }

}