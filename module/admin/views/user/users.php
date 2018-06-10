<?
    $this->title = 'admin | users';
    use yii\widgets\Pjax;
?>

<h1 class="caption-admin">Users</h1><br>
<?

Pjax::begin();

echo yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $tableUser,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered style-admin-for-table'
    ],
    'columns' => [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile_phone',
        'role',
        [
            'attribute' => 'set admin role',
            'format' => 'raw',
            'value' => function($provider) {
                return setAdmin($provider['id']);
            }
        ],
        [
            'attribute' => 'unset admin role',
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
        <a href="<?= Yii::$app->urlManager->createUrl(['/admin/user/set-admin', 'id_user' => $id_user]) ?>">set admin</a>
    <? return ob_get_clean(); ?>
<? } ?>

<? function unsetAdmin($id_user) { ?>
    <? ob_start(); ?>
    <a href="<?= Yii::$app->urlManager->createUrl(['/admin/user/set-user', 'id_user' => $id_user]) ?>">unset admin</a>
    <? return ob_get_clean(); ?>
<? } ?>

<?
Pjax::end();
?>
