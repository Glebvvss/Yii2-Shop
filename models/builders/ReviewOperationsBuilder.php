<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 03.05.2018
 * Time: 16:36
 */

namespace app\models\builders;

use app\models\ReviewOperations;

class ReviewOperationsBuilder {

    public $id;
    public $id_parent;
    public $id_product;
    public $review;

    public function id($id) {
        $this->id = $id;
        return $this;
    }

    public function idParent($id_parent) {
        $this->id_parent = $id_parent;
        return $this;
    }

    public function idProduct($id_product) {
        $this->id_product = $id_product;
        return $this;
    }

    public function review($review) {
        $this->review = $review;
        return $this;
    }

    public function build() {
        return ( new ReviewOperations($this) );
    }

}