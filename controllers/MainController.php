<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Products;
use app\models\FeedbackForm;
use app\models\JoinToMailingList;

class MainController extends Controller {

    

    public function actionFeedback() {
        $feedback_model = new FeedbackForm();
        if ( $feedback_model->load( Yii::$app->request->post() ) && $feedback_model->validate() ) {
            $feedback_model->submit();
        }

        return $this->render('feedback', [
            'feedback_model' => $feedback_model
        ]);
    }

    public function actionJoinToMailingList() {
        $email = Yii::$app->request->post('email');
        $joinToMailingList = new JoinToMailingList();
        return $joinToMailingList->joinToMailingList( $email );
    }
}


