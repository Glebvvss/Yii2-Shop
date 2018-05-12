<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\db\Products;
use app\models\Login;
use app\models\Registration;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\Response;

class SiteController extends Controller {

    public function actionIndex() {
        $products = Products::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(12)
            ->all();

        return $this->render('index', [
            'products' => $products
        ]);
    }

    public function actionLogin() {
        if ( !Yii::$app->user->isGuest ) {
            $this->goBack();
        }

        $login_model = new Login();
        if ( $login_model->load( Yii::$app->request->post() ) && $login_model->login() ) {
            return $this->goHome();
        }

        return $this->render('login', [
            'login_model' => $login_model
        ]);
    }

    public function actionRegistration() {
        $reg_model = new Registration();

        if ( Yii::$app->request->isAjax && $reg_model->load( Yii::$app->request->post() ) ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($reg_model);
        }

        if ( $reg_model->load( Yii::$app->request->post() ) ) {
            $reg_model->image = UploadedFile::getInstance($reg_model, 'image');
            $reg_model->registration();
        }

        return $this->render('registration', [
            'reg_model' => $reg_model
        ]);
    }

}
