<?

    use app\models\db\Users;
    use yii\data\ArrayDataProvider;

?>

<?

$array = Users::find()->asArray()->all();

$dataProvider = new ArrayDataProvider([
    'allModels' => $array,
    'pagination' => [
        'pageSize' => 10,
    ],
]);

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
]);
?>