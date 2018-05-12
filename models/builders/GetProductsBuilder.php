<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 27.04.2018
 * Time: 17:12
 */

namespace app\models\builders;

use Yii;
use app\models\GetProducts;

class GetProductsBuilder {

    public $sort_direction;
    public $id_category;
    public $sort_type;
    public $tag;

    public function sortDirection($sort_direction) {
        $this->sort_direction = $sort_direction;
        return $this;
    }

    public function idCategory($id_category) {
        $id_category = $this->validateIdCategory($id_category);
        $this->id_category = $id_category;
        return $this;
    }

    public function sortType($sort_type) {
        $sort_type = $this->validateSortType($sort_type);
        $this->sort_type = $sort_type;
        return $this;
    }

    public function tag($tag) {
        $tag = $this->validateTag($tag);
        $this->tag = $tag;
        return $this;
    }

    public function build() {
        return ( new GetProducts($this) );
    }


    //validate methods
    private function validateSortDirection($sort_direction) {
        if ( $sort_direction != 'ASC' || $sort_direction != 'DESC' ) {
            $sort_direction = 'DESC';
        }
        return $sort_direction;
    }

    private function validateIdCategory($id_category) {
        if ( !is_int($id_category) ) {
            return null;
        }
        return $id_category;
    }

    private function validateSortType($sort_type) {
        if ( $sort_type == null || !is_string($sort_type) ) {
            return 'position';
        }
        return $sort_type;
    }

    private function validateTag($tag) {
        if ( !is_string($tag) ) {
            $tag = null;
        }
        return $tag;
    }
    //end validate methods

}