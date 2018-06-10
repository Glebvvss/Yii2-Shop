<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 09.06.2018
 * Time: 20:23
 */

namespace app\models;

use app\models\db\DistributionMails;

class Mailing {

    public function __construct() {

    }

    public function distributionMailToFollowers( $message ) {
        $emails = DistributionMails::find()->all();
        foreach( $emails as $to ) {

            $subject = '';
            $headers = '';

            mail($to, $subject, $message, $headers);
        }
    }

    public function subscribeOnDistribution($email) {
        $distributionMails = new DistributionMails();
        $distributionMails->email = $email;
    }

}