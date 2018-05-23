<?php

namespace app\models;

use yii\base\Model;
use app\components\validators\UsernameUniqueValidator;
use app\components\validators\EmailUniqueValidator;
use app\components\validators\PasswordValidator;

class UserForm extends Model {

    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $mobile_phone;
    public $image;

    protected $image_name;

    public function rules() {
        return [
            [['first_name', 'last_name', 'username', 'email', 'password', 'confirm_password', 'mobile_phone'], 'required'],
            [['first_name', 'last_name', 'username', 'password', 'confirm_password'], 'string', 'length' => [2, 30]],
            ['mobile_phone', 'integer'],
            ['image', 'file', 'extensions' => 'png, jpg'],
            ['confirm_password', PasswordValidator::classname()],
            ['username', UsernameUniqueValidator::classname()],
            ['email', EmailUniqueValidator::classname()],
            ['email', 'email'],
        ];
    }

    protected function uploadImageFile() {
        if ( $this->validate() && $this->image ) {
            $this->image->saveAs('images/' . $this->image_name);
        }
    }

}