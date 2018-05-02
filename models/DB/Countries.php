<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 02.04.2018
 * Time: 21:25
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class Countries extends ActiveRecord {

    public static function tableName() {
        return 'countries';
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), ['id_country' => 'id']);
    }

}