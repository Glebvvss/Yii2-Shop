<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\builders\ReviewOperationsBuilder;

class ReviewController extends Controller {

    public function actionAddReviewAjax() {
        if ( !Yii::$app->request->isAjax ) {
            $this->redirect('');
        }

        $id_product = Yii::$app->request->post('id_product');
        $id_parent_review = Yii::$app->request->post('id_parent_review');
        $review = Yii::$app->request->post('review');
        $this->layout = false;

        $builder = new ReviewOperationsBuilder();
        $reviewOperations = $builder->idParent($id_parent_review)
                                    ->idProduct($id_product)
                                    ->review($review)
                                    ->build();

        $reviewOperations->addReview();
        $reviews = $reviewOperations->selectReviews();
        return $this->render('reviews-component-ajax', [
            'id_product' => $id_product,
            'reviews' => $reviews
        ]);
    }

    public function actionDeleteReviewAjax() {
        $id_product = Yii::$app->request->post('id_product');
        $id_review = Yii::$app->request->post('id_review');
        $this->layout = false;

        $builder = new ReviewOperationsBuilder();
        $reviewOperations = $builder->id($id_review)
                                    ->idProduct($id_product)
                                    ->build();

        $reviewOperations->deleteReview();
        $reviews = $reviewOperations->selectReviews();
        return $this->render('reviews-component-ajax', [
            'id_product' => $id_product,
            'reviews' => $reviews
        ]);
    }
    
}
