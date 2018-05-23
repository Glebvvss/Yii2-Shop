<?php

namespace app\admin\models;

use yii\db\Query;
use yii\data\ArrayDataProvider;
use app\models\db\Orders;
use app\models\db\Users;
use app\admin\interfaces\IOrderDetails;

class OrderDetails implements IOrderDetails {

    public function getBuyerInfo( $id_order ) {
        $id_user = $this->getUserIdByOrderId( $id_order );
        return Users::findOne(['id' => $id_user]);
    }

    private function getUserIdByOrderId( $id_order ) {
        $row = Orders::findOne(['id' => $id_order]);
        return $row->id_user;
    }

    public function getDetailsOfOrder( $id_order ) {
        $order_details = $this->getProductsOfOrder( $id_order );
        $dataProvider = $this->setDataProvider($order_details);
        return $dataProvider;
    }

    private function getProductsOfOrder( $id_order ) {
        $query = new Query();
        return $query->select('order_product.id, name_product, order_product.qty_product, products.price, img, date, time')
            ->from('order_product')
            ->join('LEFT JOIN', 'orders', 'orders.id = order_product.id_order')
            ->join('LEFT JOIN', 'products', 'products.id = order_product.id_product')
            ->where(['id_order' => $id_order])
            ->createCommand()
            ->queryAll();
    }

    private function setDataProvider($order_details) {
        return new ArrayDataProvider([
            'allModels' => $order_details,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }

}