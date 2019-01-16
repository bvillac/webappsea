<?php
Yii::setAlias('@modules', dirname(__DIR__) . '/modules');
Yii::setAlias('@themes', dirname(__DIR__) . '/themes');
Yii::setAlias('@widgets', dirname(__DIR__) . '/widgets');
Yii::setAlias('@views', dirname(__DIR__) . '/views');
Yii::setAlias('@assets', dirname(__DIR__) . '/assets');
Yii::setAlias('@web', dirname(__DIR__) . '/web');
$params = require __DIR__ . '/params.php';
//$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'websea',
    'name' => 'UTIMPOR S.A.',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'sourceLanguage' => 'en',
    'timeZone' => 'America/Guayaquil',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/webappsea',
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gHrCkD6izohFYH1FnCk-V7TsOLqfhEht',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'fileMap' => [],
                ],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'app\models\Usuario',
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
//        'assetManager' => [
//            'bundles' => [
//                'dosamigos\google\maps\MapAsset' => [
//                    'options' => [
//                        'key' => 'AIzaSyCmRPgy-jGZbT9LYO9tTckRQPjLGptYoFE',
//                        'language' => 'es',
//                        'version' => '3.1.18'
//                    ]
//                ]
//            ]
//        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        //'db' => $db,
        'view' => [
            'theme' => [
                 'class' => '\app\components\CThemeTienda',
                 'pathMap' => [
                    '@app/views' => '@app/themes/store',
                 ],
                 'baseUrl' => '@web/themes/store',
                 'themeName' => 'store',
            ],
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => '/webappsea',
            'rules' => [
                // REST patterns
                'GET api/list/<modelo:\w+>/format' => 'api/list',
                'GET api/view/<modelo:\w+>/<id:\d+>/format' => 'api/view',
                'PUT api/update/<modelo:\w+>/<id:\d+>/format' => 'api/update',
                'DELETE api/delete/<modelo:\w+>/<id:\d+>/format' => 'api/delete',
                'POST api/create/<modelo:\w+>/format' => 'api/create',
                'POST api/request/<modelo:\w+>/<metodo:\w+>/<format:\w+>' => 'api/request',
//                
                'GET api/list/<module:\w+>/<modelo:\w+>/format' => 'api/list',
                'GET api/view/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/view',
                'PUT api/update/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/update',
                'DELETE api/delete/<module:\w+>/<modelo:\w+>/<id:\d+>/format' => 'api/delete',
                'POST api/create/<module:\w+>/<modelo:\w+>/format' => 'api/create',
                'POST api/request/<module:\w+>/<modelo:\w+>/<metodo:\w+>/<format:\w+>' => 'api/request',
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api'
                ],
            ],
        ],
        
    ],
    'params' => $params,
];

/******************************************************************************/
// se agregan multiples base de datos
/*******************************************************\***********************/
$dir_data = __DIR__ . '/../datadb/';
$listFiles = scandir($dir_data);
$urlDir = "";
foreach ($listFiles as $key) {
    if (preg_match("/\.php$/", strtolower(trim($key)))) {
        $arr_data = require($dir_data . $key);
        $arr_key = array_keys($arr_data);
        $item = str_replace(".php", "", strtolower(trim($key)));
        $config['components'][$item] = $arr_data;
    }
}

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
