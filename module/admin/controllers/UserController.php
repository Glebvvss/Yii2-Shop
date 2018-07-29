<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 29.05.2018
 * Time: 4:30
 */

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\admin\models\TableUser;
use app\admin\models\RoleEditor;
use app\admin\models\TableFeedback;

class UserController extends Controller {

    public function actionUsers() {
        $this->layout = 'admin';

        $tableUser = new TableUser();
        $dataProvider = $tableUser->dataFilter( Yii::$app->request->get() );
        return $this->render('users', [
            'dataProvider' => $dataProvider,
            'tableUser' => $tableUser
        ]);
    }

    public function actionFeedback() {
        $this->layout = 'admin';

        $tableContact = new TableFeedback();
        $dataProvider = $tableContact->dataFilter( Yii::$app->request->get() );
        return $this->render('feedback', [
            'tableContact' => $tableContact,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSetAdminRole() {
        $id_user = (int) Yii::$app->request->get('id_user');

        if ( !$id_user || !is_int($id_user) ) {
            $this->redirect('/admin/user/users');
        }

        $roleEditor = new RoleEditor;
        $roleEditor->changeRole($id_user, 'admin');
        $this->redirect('/admin/user/users');
    }

    public function actionSetUserRole() {
        $id_user = Yii::$app->request->get('id_user');

        if ( !$id_user || !is_int($id_user) ) {
            $this->redirect('/admin/user/users');
        }

        $roleEditor = new RoleEditor;
        $roleEditor->changeRole($id_user, 'user');
        $this->redirect('/admin/user/users');
    }


}
