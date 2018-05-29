<?php

namespace app\models;

use app\models\db\Users;
use \yii\web\IdentityInterface;

class UserIdentity extends Users implements IdentityInterface {

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email]);
    }

    public static function findIdentityByAccessToken($token, $type = null) {}

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }
}
