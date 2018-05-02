<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 25.04.2018
 * Time: 15:40
 */

namespace app\components\validators;

use yii\validators\Validator;

class PasswordValidator extends Validator {

    public function validateAttribute($model, $attribute) {
        if ( $model->$attribute !== $model->password ) {
            $this->addError($model, $attribute, 'does not match passwords');
        }
    }

}