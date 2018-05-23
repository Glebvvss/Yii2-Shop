<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 19.05.2018
 * Time: 18:17
 */

namespace app\admin\models;

use yii\db\Query;
use yii\data\ArrayDataProvider;
use app\models\db\Orders;
use app\admin\interfaces\IOrderFilter;

class OrderFilter implements IOrderFilter {

    public function getOrdersInDataProviderFormat( $filter = 'all' ) {
        if ( $filter == null ) $filter = 'all';
        $orders = $this->getOrdersList( $filter );
        return $this->createDataProvider($orders);
    }

    public function changeStatusById( $id_order, $status ) {
        $order = Orders::find()->where(['id' => $id_order])->one();
        $order->status = $status;
        $order->update();
    }

    private function getOrdersList( $filter ) {
        if ( $filter == 'all' ) {
            return $this->getFullOrdersList();
        }
        return $this->getOrdersListByFilter( $filter );
    }

    private function getOrdersListByFilter( $filter ) {
        $query = new Query();
        return $query->select('orders.id as id_order, first_name, last_name, mobile_phone, message, total_qty, total_sum, email, username, status' )
                     ->from('orders')
                     ->join('LEFT JOIN', 'users', 'users.id = orders.id_user')
                     ->where(['status' => $filter])
                     ->createCommand()
                     ->queryAll();
    }

    private function getFullOrdersList() {
        $query = new Query();
        return $query->select('orders.id as id_order, first_name, last_name, mobile_phone, message, total_qty, total_sum, email, username, status' )
                     ->from('orders')
                     ->join('LEFT JOIN', 'users', 'users.id = orders.id_user')
                     ->createCommand()
                     ->queryAll();
    }

    private function createDataProvider($orders) {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $orders,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }

}