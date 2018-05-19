<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Users extends ActiveRecord {
	
	public static function tableName() {
		return 'users';
	}

	public function getReviews() {
		return $this->hasMany(Reviews::className(), ['id_user' => 'id']);
	}

	public function getOrders() {
        return $this->hasMany(Orders::className(), ['id_user' => 'id']);
    }
}