<?
    $this->title = 'admin | feedback';

use yii\widgets\Pjax;
?>

<h1 class="caption-admin">Feedback</h1><br>

<?

Pjax::begin();

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $tableContact,
]);

Pjax::end();

?>