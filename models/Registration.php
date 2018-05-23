<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 16.04.2018
 * Time: 13:14
 */

namespace app\models;

use Yii;
use app\models\db\Users;
use yii\db\Expression;

class Registration extends UserForm {

    public function registration() {
        if ( !$this->validate() ) return;

        if ( $this->image ) {
            $this->image_name = $this->createNameOfImageFile();
            $this->uploadImageFile();
        }

        $this->addUserToDb();
        $this->assignRole();
        return;
    }

    private function assignRole() {
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('author');
        $auth->assign($authorRole, $this->getLastUserId());
    }

    private function addUserToDb() {
        $user = new Users();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->mobile_phone = $this->mobile_phone;
        $user->image_name = $this->image_name;
        $user->save();
    }

    private function createNameOfImageFile() {
        $new_user_id = $this->makeIdOfNewUser();
        $image_name = 'user' . $new_user_id . '.' . $this->image->extension;
        return $image_name;
    }

    private function makeIdOfNewUser() {
        return $this->getLastUserId() + 1;
    }

    private function getLastUserId() {
        $id = Users::find()->select([
            'last_id'  => new Expression('MAX(users.id)')
        ])->asArray()->one();
        return $id['last_id'];
    }

}