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
        'css/flexslider.css',
        'css/component.css',
        'libs/font-awesome/css/fontawesome-all.min.css'
    ];
    public $js = [
        'js/bootstrap-3.1.1.min.js',
        'js/simpleCart.min.js',
        'js/responsiveslides.min.js',
        'js/classie.js',
        'js/cbpViewModeSwitch.js',
        'js/products-page.js',
        'js/reviews.js',
        'js/responsive-tabs.js',
        'js/responsiveslides.min.js',
        'js/imagezoom.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];
}
