<?php

namespace admin\modules\sortable\assets;

use yii\web\AssetBundle;

class SortableAsset extends AssetBundle
{
    public $sourcePath = '@admin/modules/sortable/assets';

    public $js = [
        'js/sortable.js',
    ];

    public $css = [
        'css/sortable.css',
    ];

    public $depends = [
        'admin\modules\sortable\assets\RubaxaAsset',
    ];
}
