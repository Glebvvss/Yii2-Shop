<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>


<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Eshop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="header-admin">
        <div class="menu-admin">
            <ul class="">
                <li><a href="<?= Yii::$app->urlManager->createUrl('admin/admin/orders') ?>">Orders</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl('admin/admin/statistic') ?>">Statistic</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl('admin/admin/products') ?>">Products</a></li>
                <li><a href="<?= Yii::$app->urlManager->createUrl('admin/admin/categories') ?>">Categories</a></li>
            </ul>
        </div>
    </div>

        <?=$content?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>