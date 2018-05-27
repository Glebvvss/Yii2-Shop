<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 03.05.2018
 * Time: 16:16
 */

namespace app\models;

use Yii;
use app\models\db\Reviews;
use app\models\builders\ReviewOperationsBuilder;

class ReviewOperations {

    private $id;
    private $id_parent;
    private $id_product;
    private $review;

    public function __construct( ReviewOperationsBuilder $builder ) {
        $this->id = $builder->id;
        $this->id_parent = $builder->id_parent;
        $this->id_product = $builder->id_product;
        $this->review = trim($builder->review);
    }

    public function countReviewsPerProduct() {
        return Reviews::find()->where(['id_product' => $this->id_product])
                              ->count();
    }


    public function selectReviews() {
        return Reviews::find()->where(['id_product' => $this->id_product])
                              ->joinWith('users')
                              ->orderBy(['id' => SORT_DESC])
                              ->indexBy('id')
                              ->asArray()
                              ->all();
    }

    public function addReview() {
        if ( !$this->review ) return;

        $reviews = new Reviews();
        $reviews->id_parent = $this->id_parent;
        $reviews->id_user = Yii::$app->user->getId();
        $reviews->id_product = $this->id_product;
        $reviews->review = $this->review;
        $reviews->date = date('Y-m-d');
        $reviews->time = date('H:i:s');
        $reviews->save();
    }

    public function deleteReview() {
        Reviews::findOne($this->id)->delete();
    }

}