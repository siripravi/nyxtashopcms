<?php

namespace admin\modules\products\traits;

use admin\Module;

trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('products');
    }

}
