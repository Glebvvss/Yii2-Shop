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
        <link rel="stylesheet" href="/web/css/admin-style.css">
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


    <!-- header-section-starts -->
    <div class="header">
        <div class="header-top-strip">
            <div class="container">
                <div class="header-top-left">
                    <ul>
                        <? if ( !Yii::$app->user->isGuest ) : ?>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('site/logout') ?>"><span class="glyphicon glyphicon-user"> </span>Logout</a></li>
                        <? else : ?>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>"><span class="glyphicon glyphicon-user"> </span>Login</a></li>
                        <? endif; ?>
                        <? if ( Yii::$app->user->isGuest ) : ?>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('site/registration') ?>"><span class="glyphicon glyphicon-lock"> </span>Create an Account</a></li>
                        <? endif; ?>
                        <? if ( !Yii::$app->user->isGuest ) : ?>
                            <li><a href="<?= Yii::$app->urlManager->createUrl('site/account') ?>"><i class="fas fa-pencil-alt font-awersome-icon"></i>Edit Account</a></li>
                        <? endif; ?>
                    </ul>

                    <style>
                        .font-awersome-icon {
                            font-size: 10px;
                            margin-right: 7px;
                        }
                    </style>

                </div>
                <div class="header-right">
                    <div class="cart box_1">
                        <div style="color: white;">Admin Panel</div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
    <!-- header-section-ends -->

    <div class="banner-top">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo">
                        <h1><a href=<?= Yii::$app->urlManager->createUrl('site/index') ?>><span>E</span> -Shop</a></h1>
                    </div>
                </div>
                <!--Widget for menu of website-->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?= Yii::$app->urlManager->createUrl('admin/order/orders') ?>">Orders</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('admin/product/products') ?>">Products</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('admin/category/categories') ?>">Categories</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('admin/user/users') ?>">Users</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl('admin/user/feedback') ?>">Feedback</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div style="background-color: #f7f7f7;">
        <div class="container" style="padding-top: 80px;">
            <div class="main-content">
                <?=$content?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<style>



</style>
