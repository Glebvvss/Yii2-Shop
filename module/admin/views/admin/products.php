<?
    $this->title = 'admin | products';
    use yii\helpers\Html;
?>

<h1 class="caption-admin">Products</h1>

<div class="add-product">
    <a href="<?= Yii::$app->urlManager->createUrl('admin/admin/add-product') ?>">Add Product</a>
</div>

<?

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'id',
        'name_product',
        'id_brand',
        'id_category',
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
                return Html::a('<i class="fas fa-pencil-alt"></i>', Yii::$app->urlManager->createUrl('admin/admin/index'));
            }
        ],
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function($provider) {
                return Html::a('<i class="fas fa-trash-alt"></i>', Yii::$app->urlManager->createUrl('admin/admin/index'));
            }
        ]
    ]
]);

?>
