
<?

$this->title = 'admin | products';

?>

<h1 class="caption-admin">Orders</h1>

<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-1 hidden-xs hidden-sm" id="filter-label"><b>Filter: </b></div>
    <div class="col-md-2" style="padding-right: 15px;">
        <div id="filter-select-style">
            <select id="filter-orders" class="form-control">
                <option value="all">all</option>
                <option value="new order">new order</option>
                <option value="in processing">in processing</option>
                <option value="complete">complete</option>
            </select>
        </div>
    </div>
</div>

<div id="ajax-update-orders-page">
    <?
        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'id',
                    'format' => 'raw',
                    'value' => function($provider) {
                        return $provider['id_order'];
                    }
                ],
                'username',
                'email',
                'first_name',
                'last_name',
                'mobile_phone',
                [
                    'attribute' => 'total',
                    'format' => 'raw',
                    'value' => function($provider) {
                        return '$' . sprintf("%.2f", $provider['total_sum']/100 );
                    }
                ],
                'total_qty',
                'message',
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function($provider) {
                        return statusSelect($provider);
                    }
                ],
                [
                    'attribute' => 'to order',
                    'format' => 'raw',
                    'value' => function($provider) {
                        return toDetails($provider);
                    }
                ]

            ]
        ]);
    ?>

    <? function toDetails($provider) { ?>
        <? ob_start() ?>
        <a href="<?=Yii::$app->urlManager->createUrl(['admin/order/order-details', 'id_order' => $provider['id_order'] ])?>">details</a>
        <? return ob_get_clean(); ?>
    <? } ?>

    <?  function statusSelect($provider) { ?>
        <? ob_start(); ?>
        <select class="form-control status" id="select_tag_id-<?=$provider['id_order']?>">
            <option <? if ( $provider['status'] == 'cancel order' ) echo 'selected'; ?> value="cancel order" class="delete-order-select">cancel order</option>
            <option <? if ( $provider['status'] == 'new order' ) echo 'selected'; ?> value="new order">new order</option>
            <option <? if ( $provider['status'] == 'in processing' ) echo 'selected'; ?> value="in processing">in processing</option>
            <option <? if ( $provider['status'] == 'complete' ) echo 'selected'; ?> value="complete">complete</option>
        </select>
        <? return ob_get_clean(); ?>
    <? } ?>

</div>

<div class="model_form" id="modal_form_delete_order">
    <p>Are cancel this order?</p>
    <button id="del-order" class="btn">Yes</button>
    <button id="dont-del-order" class="btn">No</button>
</div>
<div id="overlay"></div>
