<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'defaultRoute' => 'main/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'app\module\admin\AdminModule',
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                ]
            ],
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //default admin route
                '/admin' => '/admin/product/products',

                //products-page
                'shop/products/id-category/<id_category:>/<products_per_page:>/<sort_direction:>/sort-type/<sort_type:>/page/<page:>/per-page/<per-page:>/' =>  'shop/products',
                'shop/products/id-category/<id_category:>/page/<page:>/per-page/<per-page:>/' => 'shop/products',
                'shop/products/page/<page:>/per-page/<per-page:>/' => 'shop/products',
                'shop/products/id-category/<id_category:>' => 'shop/products',

                //product-single
                'shop/product-single/id-product/<id_product:>' => 'shop/product-single',

                //cart
                'cart' => 'cart/cart',

                'registration' => 'auth/registration',
                //'registration' => 'site/registration',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'cache' => 'cache' //Включаем кеширование
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qwerty',
            'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\UserIdentity',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
