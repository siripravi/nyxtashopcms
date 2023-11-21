<?php
use yii\authclient\Collection;
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'hi',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@admin' => '@app/admin'
    ],
    'components' => [
        'authClientCollection' => [
            'class' => Collection::class,
            'clients' => require __DIR__ . '/authclients.php',
        ],
        /*'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
            'bundles' => [
                'yii\bootstrap5\BootstrapPluginAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap5\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => [
                        'https://code.jquery.com/jquery-3.2.1.min.js',
                    ],
                ],
            ],
        ],*/
        /*'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'I-mmzHGFYAx9EnbueCBRo4W4HQBKHA_-',
        ],*/
        'request' => [
            'class' => 'app\components\SiteRequest',
            'cookieValidationKey' => 'I-mmzHGFYAx9EnbueCBRo4W4HQBKHA_-',
        ],
        'urlManager' => [
            'class' => 'app\components\SiteUrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'image/<size:[0-9a-z\-]+>/<name>.<extension:[a-z]+>' => 'admin/image/default/index',
                'file/<name>.<extension:[a-z]+>' => 'admin/image/default/file',
                'catalog/page-<page:[0-9]+>' => 'category/index',
                'catalog' => 'category/index',
                'catalog/<slug:[0-9a-z\-]+>/page-<page:[0-9]+>' => 'category/pod',
                'catalog/<slug:[0-9a-z\-]+>' => 'category/pod',
                'products/<slug:[0-9a-z\-]+>/page-<page:[0-9]+>' => 'category/view',
                'products/<slug:[0-9a-z\-]+>' => 'category/view',
                'product/<slug:[0-9a-z\-]+>' => 'product/index',

            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */

    ],
    'modules' => [
        'admin' => [
            'class' => 'app\admin\Module',

            'modules' => [
                'page' => [
                    'class' => 'admin\modules\page\Module',
                    'controllerNamespace' => 'admin\modules\page\controllers',
                    'userModel' => app\modules\user\models\User::class,
                ],
                'products' => [
                    'class' => 'admin\modules\products\Module',
                ],

                'image' => [
                    'class' => 'admin\modules\image\Module',
                ],
                'slider' => [
                    'class' => 'siripravi\slideradmin\Module',
                ], 
            ],
        ],
        'pages' => [
            'class' => 'wdmg\pages\Module',
            'routePrefix' => 'admin',
            'defaultRoute'  => '/pages', // route for frontend (string or array), use "/" - for root
           // 'baseLayout' => '@app/views/layouts/main', // path to default layout for render in frontend
          //  'supportLocales' => ['ru-RU', 'uk-UA', 'en-US'] // list of support locales for multi-language versions
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],//127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
