<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/bootstrap.css',
        'css/style.css',
        'css/site.css',
        'css/admin-style.css',
        'css/flexslider.css',
        'css/component.css',
        'libs/font-awesome/css/fontawesome-all.min.css'
    ];
    public $js = [
        'js/bootstrap-3.1.1.min.js',
        'js/productsPage.js',
        'js/jquery.flexisel.js',
        'js/jquery.flexslider.js',
        'js/subscribeOnMailDistribution.js',
        'js/reviews.js',
        'js/cart.js',
        'js/admin/orders.js',
        'js/admin/tagEdit.js',
        'js/admin/editProduct.js',
        'js/admin/sizeEdit.js',
        'js/admin/categories.js',
        'js/admin/categoriesModal.js',
        'js/admin/orderDetails.js',
        'js/admin/preDeleteProduct.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
