<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 19.05.2018
 * Time: 18:17
 */

namespace app\admin\models;

use Yii;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use app\models\db\Orders;
use app\admin\interfaces\IOrderFilter;
use app\models\db\OrderProduct;
use app\models\db\Products;

class OrderList implements IOrderFilter {

    public function getOrdersInDataProviderFormat( $filter = 'all' ) {
        if ( !$this->validateFilter($filter) ) {
            $filter = 'all';
        }
        $orders = $this->getOrdersList( $filter );
        return $this->createDataProvider($orders);
    }

    public function changeStatusById( $id_order, $new_status ) {
        if ( !$this->validateStatus($new_status) ) return;

        $order = Orders::find()->where(['id' => $id_order])->one();
        if ( $order->status == 'complete' ) return;

        if ( $new_status == 'cancel order' ) {
            $this->deleteOrderFromList($id_order);
            return;
        }

        if ( $new_status == 'complete' ) {
            $this->addSalesByProductId($id_order);
        }

        $order->status = $new_status;
        $order->update();
    }

    private function validateFilter($filter) {
        $tpl = '/^(new order|complete|in processing)$/';
        if ( preg_match($tpl, $filter) ) {
            return true;
        }
        return false;
    }

    private function deleteOrderFromList($id_order) {
        OrderProduct::deleteAll(['id_order' => $id_order]);
        $sql = 'DELETE FROM `orders` WHERE id = ' . $id_order;
        Yii::$app->db->createCommand($sql)->execute();
    }

    private function addSalesByProductId($id_order) {
        $products_by_order = OrderProduct::find()->where(['id_order' => $id_order])->all();
        foreach( $products_by_order as $product_by_order ) {
            $product = Products::findOne($product_by_order->id_product);
            $product->sales += $product_by_order->qty_product;
            $product->update();
        }
    }

    private function validateStatus($status) {
        $tpl = '/^(cancel order|new order|in processing|complete)$/';
        return preg_match($tpl, $status);
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
                     ->where(['status' => $filter])
                     ->orderBy(['id_order' => SORT_DESC])
                     ->createCommand()
                     ->queryAll();
    }

    private function getFullOrdersList() {
        $query = new Query();
        return $query->select('orders.id as id_order, first_name, last_name, mobile_phone, message, total_qty, total_sum, email, username, status' )
                     ->from('orders')
                     ->orderBy(['id_order' => SORT_DESC])
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