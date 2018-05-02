<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class Products extends ActiveRecord {
	
	public static function tableName() {
		return 'products';
	}

	public function getTagProduct() {
		return $this->hasOne(TagProduct::className(), ['id_product' => 'id']);
	}

	public function getCategories() {
	    return $this->hasOne(Categories::className(), ['id' => 'id_category']);
    }

    public function getSizeProduct() {
        return $this->hasOne(SizeProduct::className(), ['id_product' => 'id']);
    }

    public function getCountries() {
        return $this->hasOne(Countries::className(), ['id' => 'id_country']);
    }

    public function getBrands() {
        return $this->hasOne(Brands::className(), ['id' => 'id_brand']);
    }

    public function getReviews() {
        return $this->hasMany(Reviews::className(), ['id_product' => 'id']);
    }
}