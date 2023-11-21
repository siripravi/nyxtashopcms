<?php

namespace admin\modules\page\controllers;
use yii\web\Controller;
use yii\web\Response;

class UploadController extends Controller
{

    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        $this->module = \Yii::$app->getModule(\Yii::$app->getModule('page')->redactorModule);
        $this->attachBehavior('content', [
            'class' => 'yii\filters\ContentNegotiator',
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ],
        ]);
    }

    public function actions()
    {
        return [
            'file' => 'yii\redactor\actions\FileUploadAction',
            'image' => 'yii\redactor\actions\ImageUploadAction',
            'image-json' => 'yii\redactor\actions\ImageManagerJsonAction',
            'file-json' => 'yii\redactor\actions\FileManagerJsonAction',
        ];
    }

}
