<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 23.05.2018
 * Time: 4:02
 */

namespace app\models;

use Yii;
use app\models\db\Users;

class Account extends UserForm {

    public function getUserInformation() {
        //$id_user = Yii::$app->user->getId();
        $id_user = 3;
        return Users::findOne(['id' => $id_user]);
    }

    public function updateUser() {
        if ( !$this->validate() ) return;

        if ( $this->image ) {
            $this->image_name = $this->createNameOfImageFile();
            $this->uploadImageFile();
        }

        $this->updateUserDb();
        return;
    }

    private function updateUserDb() {
        $user = Users::find()->where(['id' => Yii::$app->user->getId()])->one();

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->mobile_phone = $this->mobile_phone;
        $user->image_name = $this->image_name;
        $user->update();
    }

    private function createNameOfImageFile() {
        $id_user = Yii::$app->user->getId();
        $image_name = 'user' . $id_user . '.' . $this->image->extension;
        return $image_name;
    }

}