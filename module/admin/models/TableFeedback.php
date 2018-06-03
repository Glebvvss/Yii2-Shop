<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 01.06.2018
 * Time: 15:48
 */

namespace app\admin\models;

use yii\base\Model;
use yii\db\Query;
use yii\data\ArrayDataProvider;

class TableFeedback extends Model {

    public $id;
    public $name;
    public $email;
    public $subject;
    public $message;
    public $date;

    public function rules() {
        return [
            ['id', 'integer'],
            [['name', 'subject', 'message'], 'string'],
            ['email', 'email'],
            ['date', 'date', 'format' => 'php:Y-m-d']
        ];
    }

    public function customLoad($data) {
        $this->load($data);
    }

    public function dataFilter($params) {
        $query = new Query();
        $query->select('*')->from('feedback')->orderBy(['id' => SORT_DESC]);

        $this->customLoad($params);
        if ( $this->validate() ) {
            $query->andFilterWhere(['id' => $this->id]);
            $query->andFilterWhere(['name' => $this->name]);
            $query->andFilterWhere(['email' => $this->email]);
            $query->andFilterWhere(['subject' => $this->subject]);
            $query->andFilterWhere(['message' => $this->message]);
            $query->andFilterWhere(['date' => $this->date]);
        }

        $products = $query->createCommand()->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $products,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $dataProvider;
    }

}