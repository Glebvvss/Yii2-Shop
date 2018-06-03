<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 30.05.2018
 * Time: 20:19
 */

namespace app\admin\models;

use yii\base\Model;
use yii\db\Query;
use yii\data\ArrayDataProvider;

class TableUser extends Model {

    public $id;
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $mobile_phone;
    public $role;

    public function rules() {
        return [
            [['id', 'mobile_phone'], 'integer'],
            [['first_name', 'last_name', 'username', 'email', 'role'], 'string'],
        ];
    }

    public function dataFilter($params) {
        $query = new Query();
        $query->select('users.id as id, first_name, last_name, username, email, mobile_phone, auth_assignment.item_name as role')
              ->from('users')
              ->join('LEFT JOIN', 'auth_assignment', 'users.id = auth_assignment.user_id');

        if ( $this->load($params) && $this->validate() ) {
            $query->andFilterWhere(['users.id' => $this->id]);
            $query->andFilterWhere(['first_name' => $this->first_name]);
            $query->andFilterWhere(['last_name' => $this->last_name]);
            $query->andFilterWhere(['username' => $this->username]);
            $query->andFilterWhere(['email' => $this->email]);
            $query->andFilterWhere(['mobile_phone' => $this->mobile_phone]);
            $query->andFilterWhere(['auth_assignment.item_name' => $this->role]);
        }

        $products = $query->createCommand()->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $products,
            'pagination' => [
                'pageSize' => 10
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'first_name',
                    'last_name',
                    'username',
                    'email',
                ],
            ],
        ]);

        return $dataProvider;
    }

}