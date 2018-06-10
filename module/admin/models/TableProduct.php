<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 11.05.2018
 * Time: 2:58
 */

namespace app\admin\models;

use yii\base\Model;
use yii\db\Query;
use yii\data\ArrayDataProvider;

class TableProduct extends Model {

    public $id;
    public $name_product;
    public $id_category;
    public $brand;

    public function rules() {
        return [
            [['id', 'id_category'], 'integer'],
            ['name_product', 'string'],
            ['brand', 'integer']
        ];
    }

    public function customLoad($data) {
        $this->load($data);
        $this->brand = $data['brand'];
        $this->id_category = $data['id_category'];
    }

    public function dataFilter($params) {
        $query = new Query();
        $query->select('products.id as id, id_category, category, id_parent as id_parent_category, id_brand, name_product, brand, color, img, about, about_large, specifications')
              ->from('products')
              ->join('LEFT JOIN', 'brands', 'products.id_brand = brands.id')
              ->join('LEFT JOIN', 'categories', 'products.id_category = categories.id');

        $this->customLoad($params);
        if ( $this->validate() ) {
            $query->andFilterWhere(['id_brand' => $this->brand]);
            $query->andFilterWhere(['products.id' => $this->id]);
            $query->andFilterWhere(['name_product' => $this->name_product]);
            $query->andFilterWhere(['id_category' => $this->id_category]);
        }

        $products = $query->createCommand()->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $products,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'name_product',
                    'brand',
                    'color',
                ],
            ],
        ]);

        return $dataProvider;
    }

}