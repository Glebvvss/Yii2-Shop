<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 25.04.2018
 * Time: 15:28
 */

namespace app\components\validators;

use yii\validators\Validator;
use app\models\db\Users;

class EmailUniqueValidator extends Validator {

    public function validateAttribute($model, $attribute) {
        $email = Users::find()->where(['email' => $model->$attribute])->one();
        if ( $email ) {
            $this->addError($model, $attribute, 'this email is used');
        }
    }

}