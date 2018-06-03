<?
    $this->title = 'admin | products';
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;
?>

<h1 class="caption-admin">Products</h1>

<hr>
<hr>

<div class="row">
    <div class="add-product col-md-3">
        <a href="<?= Yii::$app->urlManager->createUrl('admin/product/add-product') ?>">Add Product</a>
    </div>
</div>

<?

Pjax::begin();

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $tableProduct,
    'columns' => [
        'id',
        'name_product',
        [
            'attribute' => 'brand',
            'value' => 'brand',
            'filter' => Html::dropDownList('brand', '', ArrayHelper::map($brands, 'id', 'brand'), ['class' => 'form-control']),
        ],
        'color',
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function($provider) {
                return '<img src="/web/images/product/' . $provider['img'] . '">';
            }
        ],
        'about',
        'about_large',
        'specifications',
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($provider) {
                return Html::a('<i class="fas fa-pencil-alt"></i>', Yii::$app->urlManager->createUrl(['admin/product/edit-product', 'id_product' => $provider['id'] ]));
            }
        ],
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($provider) {
                return Html::a('<i class="fas fa-trash-alt">', Yii::$app->urlManager->createUrl(['admin/product/delete-product', 'id_product' => $provider['id'] ]),[ 'class' => 'pre-delete-product', 'id' => 'delete-' . $provider['id'] ]);
            }
        ]
    ]
]);

Pjax::end();

?>

<div class="modal_form" id="modal_form_delete_product">
    <p>Are you want delete selected product?</p>
    <div class="down-block">
        <div class="center-buttons">
            <button id="del-product" class="btn">Yes</button>
            <button id="dont-del-product" class="btn">No</button>
        </div>
    </div>
</div>
<div id="overlay"></div>
