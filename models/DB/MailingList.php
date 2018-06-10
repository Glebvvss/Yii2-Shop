<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 09.06.2018
 * Time: 20:33
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class MailingList extends ActiveRecord {

    public static function tableName() {
        return 'mailing_list';
    }

}