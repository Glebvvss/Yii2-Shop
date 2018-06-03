<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 29.05.2018
 * Time: 1:09
 */

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\admin\models\OrderList;
use app\admin\models\OrderDetails;
use app\models\db\Orders;

class OrderController extends Controller {

    public function actionOrders() {
        $this->layout = 'admin';

        $orderList = new OrderList();
        $dataProvider = $orderList->getOrdersInDataProviderFormat();
        return $this->render('orders', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdateOrderPageByFilterAjax() {
        if ( !Yii::$app->request->isAjax ) {
            $this->goBack();
        }

        $filter = Yii::$app->request->get('filter');
        $this->layout = false;

        $orderList = new OrderList();
        $dataProvider = $orderList->getOrdersInDataProviderFormat( $filter );
        return $this->render('orders-table', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionUpdateStatusOfOrderAjax() {
        if ( !Yii::$app->request->isAjax ) {
            $this->goBack();
        }

        $id_order = Yii::$app->request->get('id_order');
        $status = Yii::$app->request->get('status');
        $filter = Yii::$app->request->get('filter');
        $this->layout = false;

        $orderList = new OrderList();
        $orderList->changeStatusById($id_order, $status);
        $dataProvider = $orderList->getOrdersInDataProviderFormat( $filter );
        return $this->render('orders-table', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionOrderDetails() {
        $id_order = Yii::$app->request->get('id_order');
        $this->layout = 'admin';

        $messageFromUser = Orders::find()->select('message')
            ->where(['id' => $id_order])
            ->one();

        $orderDetails = new OrderDetails();
        $dataProvider = $orderDetails->getDetailsOfOrder( $id_order );
        $buyerData = $orderDetails->getBuyerInfo( $id_order );
        return $this->render( 'order-details', [
            'messageFromUser' => $messageFromUser,
            'dataProvider' => $dataProvider,
            'buyerData' => $buyerData
        ]);
    }

    public function actionUpdateStatusOrderDetailsAjax() {
        if ( !Yii::$app->request->isAjax ) {
            $this->goBack();
        }

        $id_order = Yii::$app->request->post('id_order');
        $status = Yii::$app->request->post('status');

        $orderList = new OrderList();
        $orderList->changeStatusById($id_order, $status);
    }

}