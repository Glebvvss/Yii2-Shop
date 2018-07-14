<?php


namespace app\models;

use Yii;
use yii\base\Model;
use app\models\db\Users;
use app\components\validators\EmailUsedValidator;

class ForgetPassword extends Model {
    
    public $email;

    public function rules() {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', EmailUsedValidator::className()]
        ];
    }

    public function generateAndSendNewPassword() {
        if ( !$this->validate() ) return;

        $user = Users::findOne(['email' => $this->email]);
        if ( $user ) {
            $new_password = $this->passwordGenerator();
            $user->password = password_hash( $new_password, PASSWORD_BCRYPT );
            $user->save();
        }
        
        $this->sendPasswordToUser($new_password);
    }

    private function passwordGenerator() {
        return md5(uniqid(rand(),true));
    }

    private function sendPasswordToUser($new_password) {
        $to = $this->email;
        $subject = 'Your new password';
        $message = $new_password;
        $headers = 'From: glebvvss@my-dress-shop.zzz.com.ua' . "\r\n";
        mail($to , $subject , $message, $headers);        
    }

}