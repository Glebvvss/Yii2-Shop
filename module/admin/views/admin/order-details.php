<?
    $this->title = 'Admin | Order Details';
?>

<div class="back-to-list">
    <p><a href="<?=Yii::$app->urlManager->createUrl('admin/admin/orders')?>">Back To List</a></p>
</div>

<div class="status-block">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="col-md-2" style="margin-top: 5px;"><b>Status: </b></div>
        <div class="col-md-10">
            <select class="form-control status" id="status-<?= $_GET['id_order'] ?>">
                <option <? if ( $provider['status'] == 'new order' ) echo 'selected'; ?> value="new order">new order</option>
                <option <? if ( $provider['status'] == 'in processing' ) echo 'selected'; ?> value="in processing">in processing</option>
                <option <? if ( $provider['status'] == 'complete' ) echo 'selected'; ?> value="complete">complete</option>
            </select>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
                <td>Username</td>
                <td>Email</td>
                <td>Name</td>
                <td>Last Name</td>
                <td>Mobile Phone</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $buyerData->username ?></td>
                <td><?= $buyerData->email ?></td>
                <td><?= $buyerData->first_name ?></td>
                <td><?= $buyerData->last_name ?></td>
                <td><?= $buyerData->mobile_phone ?></td>
            </tr>
        <tbody>
    </table>
    <hr>
</div>

<? if ( $messageFromUser->message ) : ?>
    <div>
        <p style="text-align: center;"><b>Message</b></p>
        <p>
            <?=$messageFromUser->message?>
        </p>
    </div>
<? endif; ?>

<?

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name_product',
        'qty_product',
        'price',
        'img',
        'date',
        'time',
        [
            'attribute' => 'img',
            'format' => 'raw',
            'value' => function($provider) {
                return img($provider);
            }
        ]
    ]
]);
?>

<? function img($provider) { ?>
    <? ob_start(); ?>
    <img style="width: 80px;" src="/web/images/product/<?=$provider['img']?>">
    <? return ob_get_clean(); ?>
<? } ?>