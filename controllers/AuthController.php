<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\db\Products;
use app\models\Login;
use app\models\Registration;
use app\models\Account;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\FeedbackForm;
use app\models\JoinToMailingList;
use app\models\ForgetPassword;
use app\models\ChangePassword;

class AuthController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'registration', 'login', 'account'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout', 'account'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['registration', 'login'],
                        'roles' => ['?'],
                    ]
                ],
            ],
        ];
    }

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

        $forget_password_model = new ForgetPassword();
        return $this->render('login', [
            'forget_password_model' => $forget_password_model,
            'login_model' => $login_model
        ]);
    }

    public function actionLogout() {
        if ( !Yii::$app->user->isGuest ) {
            Yii::$app->user->logout();
        }
        $this->goHome();
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
            $this->goHome();
        }

        return $this->render('registration', [
            'reg_model' => $reg_model
        ]);
    }

    public function actionAccount() {
        $account_model = new Account();

        if ( Yii::$app->request->isAjax && $account_model->load( Yii::$app->request->post() ) ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($account_model);
        }

        if ( $account_model->load( Yii::$app->request->post() ) ) {
            $account_model->image = UploadedFile::getInstance($account_model, 'image');
            $account_model->updateUser();
        }

        $change_password_model = new ChangePassword();
        $user = $account_model->getUserInformation();
        return $this->render('account', [
            'change_password_model' => $change_password_model,
            'account_model' => $account_model,
            'user' => $user
        ]);
    }

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

    public function actionForgetPassword() {
        $forget_password_model = new ForgetPassword();
        if ( $forget_password_model->load( Yii::$app->request->post() ) ) {
            $this->redirect('login');
        }
        
        if ( Yii::$app->request->isAjax ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($forget_password_model);
        } else {
            $forget_password_model->generateAndSendNewPassword();
            $this->redirect('login');
        }
    }

    public function actionChangePassword() {
        $change_password_model = new ChangePassword();
        if ( !$change_password_model->load( Yii::$app->request->post() ) ) {
            $this->redirect('account');    
        }
        
        if ( Yii::$app->request->isAjax ) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($change_password_model);
        } else {
            $change_password_model->setNewPassword();
            $this->redirect('account');
        }        
    }

}

