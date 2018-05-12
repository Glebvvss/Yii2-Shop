<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 11.05.2018
 * Time: 2:58
 */

namespace app\models;

use yii\base\Model;
use app\models\db\Products;
use yii\data\ActiveDataProvider;


class SearchFilter extends Products {

    public function rules() {
        return [
            [['id'], 'integer'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = Products::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (! ( $this->load($params) && $this->validate() ) ) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        return $dataProvider;
    }

}