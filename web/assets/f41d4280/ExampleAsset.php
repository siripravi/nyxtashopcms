<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Class ExampleAsset
 * @package dominus77\owlcarousel2\assets
 */
class ExampleAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    /**
     * @var array
     */
    public $css = ['css/styles.css', 'css/example.css'];
    public $js = ['js/main.js'];
}
