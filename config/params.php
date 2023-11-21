<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'order_secret' => 'SiriPravi',
    'user.avatar.size' => [200, 200],
    'phone1' => '',
    'phone1f' => '',
    'currency_id' => 'USD',
    'companyName' => 'Nyxta',
    'bsVersion' => '5.x',
    'icon-framework' => \kartik\icons\Icon::FAS,
    'page' => [
        'imgFilePath' => '@webroot/image/blog/',
        'imgFileUrl' => '@webroot/image/blog/',
        'userModel' => app\models\User::class,
        'userPK' => 'id',
        'userName' => 'username',
        'urlManager' => 'urlManager',
        'pagePostPageCount' => 10,
        'pageCommentPageCount' => 20,
        'userModel' => app\models\User::class,
        'userPk' => 'id',
        'userName' => 'username',
        'enableComments' => true
    ],
    'file' => [
        'extensions' => 'png, jpg, jpeg, pdf, zip, rar, doc, docx, xls, xlsx',
        'maxSize' => 100 * 1024 * 1024,
        'maxFiles' => 50,
       'path' => dirname(__DIR__) . '/files',
       
    ],

    'image' => [
        'extensions' => 'png, jpg, jpeg',
        'path' => 'image',
        'jpeg_quality' => 85,
        'convert' => true,
        /*'watermark' => [
            'enabled' => false,
            'absolute' => false,
            'file' => '@webroot/images/watermark.png',
            'x' => 50,
            'y' => 70,
        ],*/
        'none' => '/image/photo-default.png',
        'size' => [
            'page' => [
                'width' => 600,
                'height' => 450,
                'method' => 'clip',
            ],
            'cover' => [
                'width' => 200,
                'height' => 200,
                'method' => 'fill',
                'watermark' => [
                    'enabled' => false,
                ],
            ],
            'fill' => [
                'width' => 400,
                'height' => 400,
                'method' => 'fill',
                'watermark' => [
                    'enabled' => false,
                ],
            ],
            'category' => [
                'width' => 340,
                'height' => 260,
                'method' => 'fill',
                'bg' => '#FFFFFF',
                /* 'watermark' => [
                     'width' => 102,
                 ],*/
                'none' => '@webroot/image/site/category-default.png',
            ],
            'big' => [
                'width' => 1000,
                'height' => 1000,
                'method' => 'fill',
                'bg' => '#FFFFFF',
            ],
            'normal' => [
                'width' => 450,
                'height' => 450,
                'method' => 'fill',
                'bg' => '#FFFFFF',
                'watermark' => [
                    'enabled' => false,
                    //'width' => 130,
                ],
            ],
            'rss' => [
                'width' => 450,
                'height' => 450,
                'method' => 'fill',
                'bg' => '#FFFFFF',
                //  'watermark' => false,
            ],
            'small' => [
                'width' => 240,
                'height' => 240,
                'method' => 'fill',
                'bg' => '#FFFFFF',
                'watermark' => false,
                'watermark' => [
                    'enabled' => false,
                    'width' => 72,
                ],
            ],
            'micro' => [
                'width' => 135,
                'height' => 135,
                'method' => 'fill',
                // 'bg' => '#FFFFFF',
                'watermark' => [
                    'enabled' => false,
                    'width' => 35,
                ],
            ],
        ],
    ],
];
