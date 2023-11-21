<?php

namespace app\modules\cart;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\cart\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
       // $this->layout = '@app/views/layouts/base';	
        parent::init();
    }
}
