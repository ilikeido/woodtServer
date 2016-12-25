<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

$config = [
    'id' => 'pfast-api',
//     'homeUrl'=>'site/index',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'cookieValidationKey' => 'w3BnewAWmCrjijzkiLucYD5Ty1Ym_V9F',
        ],
        'user'=>[
            'identityClass' => 'api\models\UserAccount',
            'enableAutoLogin' => true,
            'enableSession'=>false,
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'timeout'=>60*60*24,
//            'db' => 'mydb',  // 数据库连接的应用组件ID，默认为'db'.
//            'sessionTable' => 'my_session', // session 数据表名，默认为'session'.
        ],
        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/log/error.log',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'areas','pluralize' => false,],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211
                ],
            ],
            'useMemcached' => true ,
        ],

    ],
    'params' => $params,
    'language'=>'zh-CN'
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'model' => [
                'class' => 'yii\gii\generators\model\GeneratorCommon',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\model\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/model/adminlte',
                ]
            ],
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
//                     'adminlte' => '..\..\vendor\yiisoft\yii2-gii\generators\crud\adminlte',
                    'adminlte' => '../../vendor/yiisoft/yii2-gii/generators/crud/adminlte',
                ]
            ],
        ]
    ];
}

return $config;
