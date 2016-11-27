<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'Init '=>[
        'class'=>'app\components\Init '
        ],
        'bootstrap' => ['log','Init'],
    ],
];
