<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 23.05.2018
 * Time: 3:30
 */

namespace app\models\db;

use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord {

    public static function tableName() {
        return 'order_product';
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['id' => 'id_order']);
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), ['id' => 'id_product']);
    }

}