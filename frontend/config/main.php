<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'Init '=>[
        'class'=>'frontend\components\Init'
        ],
        'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
        '/' => 'user/index',
        '/blog/'=>'user/index',
        '/blog/users/' => 'user/index',
        'blog/logout' => 'blog/logout',
        '/blog/users/<id:\w+>' => 'blog/user-post',
        '/blog/create/' => 'blog/post-create',
        '/blog/login/' => '/blog/login/',
        '/blog/<id:\w+>/update' => 'blog/post-update',
        '/blog/<id:\w+>/' => 'blog/post'
        ],
    
        ],
        'user' => [
            'loginUrl' => array('/blog/login'),
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
   'bootstrap' => ['log','frontend\components\Init'],
    
    'params' => $params,
];
