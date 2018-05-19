<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 19.05.2018
 * Time: 8:57
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class Orders extends ActiveRecord {

    public static function tableName() {
        return 'orders';
    }

    public function getProducts() {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    public function getUsers() {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

}