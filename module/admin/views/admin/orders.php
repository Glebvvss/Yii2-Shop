<?

$this->title = 'admin | products';

use yii\db\Query;
use yii\data\ArrayDataProvider;

?>

    <h1 class="caption-admin">Orders</h1>

    <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-1">Filter: </div>
        <div class="col-md-2" style="padding-right: 15px;">
            <select class="form-control">
                <option value="all">all</option>
                <option value="new order">new order</option>
                <option value="in processing">in processing</option>
                <option value="complete">complete</option>
            </select>
        </div>
    </div>

<?

$query = new Query();
$orders = $query->select('*')
                ->from('orders')
                ->join('LEFT JOIN', 'products', 'products.id = orders.id_product')
                ->join('LEFT JOIN', 'users', 'users.id = orders.id_user')
                ->createCommand()
                ->queryAll();

//debug($orders);

$dataProvider = new ArrayDataProvider([
    'allModels' => $orders,
    'pagination' => [
        'pageSize' => 10,
    ],
]);

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name_product',
        'price',
        'qty',
        'username',
        'email',
        'first_name',
        'last_name',
        'mobile_phone',
        'messege',
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function($provider) {
                return '<select class="form-control">
                            <option value="new orders">new order</option>
                            <option value="in processing">in processing</option>
                            <option value="complete">complete</option>
                        </select>';
            }
        ],

    ]
]);


?>