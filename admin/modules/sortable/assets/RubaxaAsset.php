<?php

namespace admin\modules\sortable\assets;

use yii\web\AssetBundle;

class RubaxaAsset extends AssetBundle
{
    public $sourcePath = '@bower/sortablejs';

    public $js = [
        'Sortable.min.js',
        'jquery.binding.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
