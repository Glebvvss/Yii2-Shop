<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Login extends Model {

    public $email;
    public $password;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
            ['email', 'email']
        ];
    }

    public function validatePassword($attribute) {
        if ( $this->hasErrors() ) return;

        $user = $this->getUser();
        if (!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, 'Incorrect username or password.');
        }
    }

    public function login() {
        if ( !$this->validate() ) return false;

        $user = $this->getUser();
        Yii::$app->user->login($user);
        return true;
    }

    private function getUser() {
        return UserIdentity::findByEmail($this->email);
    }

}
