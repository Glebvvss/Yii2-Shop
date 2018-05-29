<?
    $this->title = 'admin | products';
    use yii\helpers\Html;
?>

<h1 class="caption-admin">Products</h1>

<hr>
<hr>

<div class="row">
    <div class="add-product col-md-3">
        <a href="<?= Yii::$app->urlManager->createUrl('admin/product/add-product') ?>">Add Product</a>
    </div>
    <div class="col-md-6">

    </div>
    <div class="col-md-3 row" style="float: right;">
        <div class="col-md-3">
            <label class="label-brand">Brands: </label>
        </div>
        <div class="col-md-9">
            <select class="form-control">
                <option></option>
                <option></option>
                <option></option>
            </select>
        </div>
    </div>
</div>

<?

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'name_product',
        'color',
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function($provider) {
                return '<img src="/web/images/product/' . $provider->img . '">';
            }
        ],
        'about',
        'about_large',
        'specifications',
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($provider) {
                return Html::a('<i class="fas fa-pencil-alt"></i>', Yii::$app->urlManager->createUrl(['admin/product/edit-product', 'id_product' => $provider->id ]));
            }
        ],
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($provider) {
                return Html::a('<i class="fas fa-trash-alt"></i>', Yii::$app->urlManager->createUrl(['admin/product/delete-product', 'id_product' => $provider->id]),[ 'class' => 'pre-delete-product', 'id' => $provider->id ]);
            }
        ]
    ]
]);

?>

<div id="modal_form_delete_product">
    <p>Are you want delete selected product?</p>
    <button id="del-product" class="btn">Yes</button>
    <button id="dont-del-product" class="btn">No</button>
</div>
<div id="overlay"></div>
