<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

include_once __DIR__ . '/../models/DB/autoload.php';
include_once __DIR__ . '/../models/Interfaces/autoload.php';
include_once __DIR__ . '/../traits/autoload.php';
include_once __DIR__ . '/../components/validators/autoload.php';
include_once __DIR__ . '/../functions.php';

(new yii\web\Application($config))->run();
