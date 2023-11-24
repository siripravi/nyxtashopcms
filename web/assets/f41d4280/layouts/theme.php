<?php

/**
 * @var $this \luya\web\View
 */
//use siripravi\catalog\frontend\ResourcesAsset;
use app\themes\demo\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);


$bannerBg = (!null == Yii::$app->getRequest()->getQueryParam('slug')) ? "url(/image/site/page_header.jpg)" : null;

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en<!--?= Yii::$app->composition->getLangShortCode(); ?>--">

<head>
    <title><?= $this->title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <?php $this->head() ?>
</head>

<body class="home is-preload">
    <?php $this->beginBody() ?>
    <!--====== PRELOADER PART START ======-->
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo Html::beginTag('header', [
        'id' => 'home',
        'class' => 'main_header_area',
        'style' => ['background' => $bannerBg, "background-size" => "cover;"],
    ]) ?>
    <?php echo $this->render('_mainhdr') ?>
    <!--?= Yii::$app->getRequest()->getQueryParam('slug') ?-->
    <div class="main_menu_area"> <?php echo $this->render('_nav') ?> </div>
    </header>

    <!--====== PRELOADER PART ENDS ======-->
    <!--?php echo $this->render('_mobileNavbar') ?-->
    <!--?php echo $this->render('_header') ?-->
    <!--?php echo $this->render('_header3') ?-->

    <?php echo $content ?>
    <?php echo $this->render('_footer2') ?>
    <?php echo $this->render('_mobileBottomNav') ?>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>