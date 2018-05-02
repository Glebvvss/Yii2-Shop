<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 02.04.2018
 * Time: 21:34
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class Brands extends ActiveRecord {

    public static function tableName() {
        return 'brands';
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), ['id_brand' => 'id']);
    }

}