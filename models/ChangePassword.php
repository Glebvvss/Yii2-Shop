<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\db\Users;

class ChangePassword extends Model {
    
    public $current_password;
    public $new_password;
    public $confirm_new_password;

    public function rules() {
        return [
            [['current_password', 'new_password', 'confirm_new_password'], 'required'],
            ['current_password', 'validateCurrentPassword'],
            ['confirm_new_password', 'validateNewPassword']
        ];
    }

    public function validateCurrentPassword($attribute) {
        $user = $this->getUser();
        if ( !password_verify($this->$attribute, $user->password ) ) {
            $this->addError($attribute, 'Incorrent current password');
        }
    }

    public function validateNewPassword($attribute) {
        if ( $this->new_password !== $this->confirm_new_password ) {
            $this->addError($attribute, 'Passwords do not match');
        }
    }

    public function setNewPassword() {
        if ( !$this->validate() ) return false;

        $user = $this->getUser();
        $user->password = password_hash($this->new_password, PASSWORD_BCRYPT);
        $user->save();
    }

    private function getUser() {
        $id_user = Yii::$app->user->getId();        
        return Users::findOne($id_user);
    }    

}