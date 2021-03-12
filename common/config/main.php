<?php
return [
    'name'=>'Отпуска',
    'sourceLanguage' => 'en',
    'language' => 'ru',
    'defaultRoute'=>'vacation',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',

        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
