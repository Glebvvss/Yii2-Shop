<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Categories extends ActiveRecord {
	
	public static function tableName() {
		return 'categories';
	}

	public function getProducts() {
		return $this->hasMany(Products::className(), ['id_category' => 'id']);
	}

}