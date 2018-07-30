<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Products;
use app\models\FeedbackForm;
use app\models\JoinToMailingList;

class MainController extends Controller {

    public function actionIndex() {
        $products = Products::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(12)
            ->all();

        return $this->render('index', [
            'products' => $products
        ]);
    }

    public function actionFeedback() {
        $feedback_form = new FeedbackForm();
        if ( $feedback_form->load( Yii::$app->request->post() ) && $feedback_form->validate() ) {
            $feedback_form->submit();
        }

        return $this->render('feedback', [
            'feedback_form' => $feedback_form
        ]);
    }

    public function actionJoinToMailingList() {
        $email = Yii::$app->request->post('email');
        $joinToMailingList = new JoinToMailingList();
        return $joinToMailingList->joinToMailingList( $email );
    }
}


