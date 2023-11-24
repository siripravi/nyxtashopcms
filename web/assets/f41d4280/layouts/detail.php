<?php

/**
 * @var $this \luya\web\View
 */
//use siripravi\catalog\frontend\ResourcesAsset;
use app\resources\assets\AppAsset;

AppAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->composition->getLangShortCode(); ?>">

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
    <?php echo $this->render('_header2') ?>
    hhjhkhkkhhk
    <?php echo $content ?>
    Patisserie Malako At Jerningham and Royal Street
    <?php echo $this->render('_footer') ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>