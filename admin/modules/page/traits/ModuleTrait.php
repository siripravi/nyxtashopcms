<?php

namespace admin\modules\page\traits;
use yii;
use admin\modules\page\Module;

trait ModuleTrait
{
    /**
     * @return Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('page');
    }

}
