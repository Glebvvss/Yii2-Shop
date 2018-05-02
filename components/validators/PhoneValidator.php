<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 25.04.2018
 * Time: 18:38
 */

namespace app\components\validators;

use yii\validators\Validator;

class PhoneValidator extends Validator {

    public function validateAttribute($model, $attribute) {

        $a = preg_match('[0-9+]', $attribute);
        //preg_match('[0-9+]', $attribute);

        if ( $a != true ) {
            $this->addError($model, $attribute, 'does not match passwords');
        }
    }

}