<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 29.05.2018
 * Time: 4:30
 */

namespace app\module\admin\controllers;

use yii\web\Controller;

class UserController extends Controller {

    public function actionUsers() {
        $this->layout = 'admin';
        return $this->render('users');
    }

}