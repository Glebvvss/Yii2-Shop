<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 25.04.2018
 * Time: 15:25
 */

namespace app\components\validators;

use yii\validators\Validator;
use app\models\db\Users;

class UsernameUniqueValidator extends Validator {

    public function validateAttribute($model, $attribute) {
        $user = Users::find()->where(['username' => $model->$attribute])->one();
        if ( $user ) {
            $this->addError($model, $attribute, 'this username is used');
        }
    }

}