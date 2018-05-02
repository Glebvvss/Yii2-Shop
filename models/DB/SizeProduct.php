<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 02.04.2018
 * Time: 19:28
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class SizeProduct extends ActiveRecord {

    public static function tableName() {
        return 'size_product';
    }

    public function getSizes() {
        return $this->hasMany(Sizes::className(), ['id' => 'id_size']);
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), ['id' => 'id_product']);
    }

}