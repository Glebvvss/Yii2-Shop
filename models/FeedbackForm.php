<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 01.06.2018
 * Time: 3:39
 */

namespace app\models;

use yii\base\Model;
use app\models\db\Feedback;

class FeedbackForm extends Model {

    public $name;
    public $email;
    public $subject;
    public $message;

    public function rules() {
        return [
            [['name', 'email', 'subject', 'message'], 'required'],
            [['name', 'message', 'subject'], 'string'],
            ['email', 'email']
        ];
    }

    public function submit() {
        $feedback = new Feedback();

        $feedback->name = $this->name;
        $feedback->email = $this->email;
        $feedback->subject = $this->subject;
        $feedback->message = $this->message;
        $feedback->date = date(date('Y-m-d'));
        $feedback->save();
    }

}