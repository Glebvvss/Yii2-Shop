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

    public function getUsers() {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    public function getOrderProduct() {
        return $this->hasOne(OrderProduct::className(), ['id_order' => 'id']);
    }

}