<?php

namespace admin\modules\image\assets;

use yii\web\AssetBundle;

class ImageUploadAsset extends AssetBundle
{
    public $sourcePath = '@admin/modules/image/assets';
	//public $baseUrl = '@web';
	public $css = [
        'css/image-upload.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\bootstrap5\BootstrapAsset',
        'kartik\file\FileInputAsset',
        'kartik\base\WidgetAsset',
    ];
}
