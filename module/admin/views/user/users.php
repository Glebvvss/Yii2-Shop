<?
    $this->title = 'admin | users';
    use yii\widgets\Pjax;
?>

<?

Pjax::begin();

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $tableUser,
    'columns' => [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile_phone',
        'role',
        [
            'attribute' => 'give administrator rights',
            'format' => 'raw',
            'value' => function($provider) {
                return setAdmin($provider['id']);
            }
        ],
        [
            'attribute' => 'pick admin rights',
            'format' => 'raw',
            'value' => function($provider) {
                return unsetAdmin($provider['id']);
            }
        ],
    ]
]);

?>

<? function setAdmin($id_user) { ?>
    <? ob_start(); ?>
        <a href="<?= Yii::$app->urlManager->createUrl(['/admin/user/set-admin', 'id_user' => $id_user]) ?>">set admin</a>'
    <? return ob_get_clean(); ?>
<? } ?>

<? function unsetAdmin($id_user) { ?>
    <? ob_start(); ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['/admin/user/set-user', 'id_user' => $id_user]) ?>">unset admin</a>'
    <? return ob_get_clean(); ?>
<? } ?>

<?
Pjax::end();
?>
