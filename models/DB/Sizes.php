<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 02.04.2018
 * Time: 19:23
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class Sizes extends ActiveRecord {

    public static function tableName() {
        return 'sizes';
    }

    public function getSizeProduct() {
        return $this->hasOne(SizeProduct::className(), ['id_size' => 'id']);
    }

}