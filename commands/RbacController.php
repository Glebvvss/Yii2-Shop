<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 19.04.2018
 * Time: 20:51
 */

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);
    }

}