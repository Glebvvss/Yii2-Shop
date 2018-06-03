<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 01.06.2018
 * Time: 15:01
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class Feedback extends ActiveRecord {

    public static function tableName() {
        return 'feedback';
    }

}