<?php

namespace admin\modules\image\widgets\assets;

use yii\web\AssetBundle;

class ImageUploadAsset extends AssetBundle
{
   // public $sourcePath = '@app/modules/image';
	//public $baseUrl = '@app/modules/image/assets';
	public $css = [
        'css/image-upload2.css',
       //'css/bs5-fileinput.css'
    ];
    public $js = [
    ];
    public $depends = [
       // 'yii\bootstrap\BootstrapAsset',
        'kartik\file\FileInputAsset',
        'kartik\base\WidgetAsset',
    ];
	public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/";
        parent::init();
    }
}
