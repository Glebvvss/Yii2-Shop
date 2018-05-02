<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class TagProduct extends ActiveRecord {
	
	public static function tableName() {
		return 'tag_product';
	}

	public function getTags() {
		return $this->hasMany(Tags::className(), ['id' => 'id_tag']);
	}

	public function getProducts() {
		return $this->hasMany(Products::className(), ['id' => 'id_product']);
	}
}