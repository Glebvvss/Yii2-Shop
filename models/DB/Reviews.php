<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Reviews extends ActiveRecord {
	
	public static function tableName() {
		return 'reviews';
	}

	public function getUsers() {
		return $this->hasOne(Users::className(), ['id' => 'id_user']);
	}

	public function getProducts() {
		return $this->hasOne(Products::className(), ['id' => 'id_product']);
	}
}