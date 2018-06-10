<?php

namespace app\models;

use yii\base\Model;
use app\models\db\MailingList;

class JoinToMailingList extends Model {

    public $email;

    public function rules() {
        return [
            ['email', 'required'],
            ['email', 'email']
        ];
    }

    public function joinToMailingList( $email ) {
        $this->email = $email;
        if ( !$this->validate() ) return false;

        $distributionMails = new MailingList();
        $distributionMails->email = $this->email;
        $distributionMails->save();

        return true;
    }

}