<?php

namespace admin\modules\image;

use Yii;

/**
 * Class Module
 *
 * @package dench\image
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'admin\modules\image\controllers';

    public function init()
    {
        parent::init();
          
        Yii::$app->i18n->translations['page'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@admin/modules/image/messages',
        ];
    }
}