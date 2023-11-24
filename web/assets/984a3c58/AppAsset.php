<?php

namespace app\themes\demo;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
   // public $sourcePath = '@app/resources/assets/dist';
   public $sourcePath = '@app/themes/demo';
   public $css = [
      // '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
      //  '//cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
      // '//unpkg.com/aos@2.3.1/dist/aos.css',
      //'css/animate.css',
      //'css/magnific-popup.css',
      //'css/slick.css',
      'css/font-awesome.min.css',
      'css/vendors/linearicons/style.css',
      'css/vendors/flat-icon/flaticon.css',
      'css/bootstrap.min.css',
      // "//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css", 
      'css/vendors/revolution/css/settings.css',
      'css/vendors/revolution/css/layers.css',

      'css/vendors/revolution/css/navigation.css',
      'css/vendors/animate-css/animate.css',
      'css/vendors/owl-carousel/owl.carousel.min.css',
      'css/vendors/magnifc-popup/magnific-popup.css',
      'css/style.css',
      'css/responsive.css'
      // 'css/style.css'    //YII_ENV_DEV ?  YII_ENV_DEV ?
   ];
   public $js = [
      '//unpkg.com/aos@2.3.1/dist/aos.js',

      "js/popper.min.js",
      "js/bootstrap.min.js",
      /*"vendors/revolution/js/jquery.themepunch.tools.min.js",
        "vendors/revolution/js/jquery.themepunch.revolution.min.js",
        "vendors/revolution/js/extensions/revolution.extension.actions.min.js",
        "vendors/revolution/js/extensions/revolution.extension.video.min.js",
        "vendors/revolution/js/extensions/revolution.extension.slideanims.min.js",
        "vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js",
        "vendors/revolution/js/extensions/revolution.extension.navigation.min.js", */
      "vendors/owl-carousel/owl.carousel.min.js",
      "vendors/magnifc-popup/jquery.magnific-popup.min.js",
      "vendors/datetime-picker/js/moment.min.js",
      "vendors/datetime-picker/js/bootstrap-datetimepicker.min.js",
      "vendors/nice-select/js/jquery.nice-select.min.js",
      "vendors/jquery-ui/jquery-ui.min.js",
      "vendors/lightbox/simpleLightbox.min.js",

      "js/theme.js",


      // 'js/all.js'    // YII_ENV_DEV ? : 'js/all.min.js'
   ];

   public $depends = [
      'yii\web\YiiAsset',
      'yii\web\JqueryAsset',
      // 'yii\bootstrap\BootstrapAsset',
      // 'yii\bootstrap\BootstrapPluginAsset',
     // 'yidas\yii\fontawesome\FontawesomeAsset',
    //  'yii\materialicons\AssetBundle'
  ];

  /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
