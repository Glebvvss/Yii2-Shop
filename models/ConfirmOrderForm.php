<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 08.06.2018
 * Time: 18:22
 */

namespace app\models;

use yii\base\Model;

class ConfirmOrderForm extends Model {

    public $email;
    public $first_name;
    public $last_name;
    public $mobile_phone;
    public $message;

    public function rules() {
        return [
            [['first_name', 'last_name', 'message'], 'string'],
            ['mobile_phone', 'integer'],
            ['email', 'email']
        ];
    }

}