<?
    $this->title = 'admin | feedback';

use yii\widgets\Pjax;
?>

<?

Pjax::begin();

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $tableContact,
]);

Pjax::end();

?>