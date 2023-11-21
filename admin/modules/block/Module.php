<?php

namespace admin\modules\block;

use Yii;

/**
 * Class Module
 *
 * @package admin\modules\admin\block
 */
class Module extends \yii\base\Module
{
    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'admin\modules\block\controllers';

    public function init()
    {
        parent::init();

        Yii::$app->i18n->translations['block'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => '@admin\modules\block/messages',
        ];
    }
}