<?php


use luya\cms\models\NavItem;

?>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\cart\widgets\CartWidget;
use app\modules\cart\widgets\CartIconWidget;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Popover;
?>
<?php
$menuItems = []; //<iconify-icon icon="mdi:user-outline" style="color: #123;" width="20" rotate="0deg"></iconify-icon>

?>
<!-- Top Nav -->
<div class="col-12 bg-white pt-4">
    <div class="row">
        <div class="col-lg-auto">
            <div class="site-logo text-center text-lg-left">
                <a href="index.html">Nyxta Shop</a>
            </div>
        </div>
        <div class="col-lg-5 mx-auto mt-6 mt-lg-0">
            <?= $this->render('_searchForm');  ?>
            
        </div>
        <div class="col-lg-auto text-center text-lg-left header-item-holder d-inline-flex ps-4">
            <?= CartIconWidget::widget(); ?>
        </div>
    </div>
</div>
<!-- Navbar begins  -->
<?php
NavBar::begin([
    //'brandLabel' => '<span class="gaozhan-logo">'.Html::img("/image/site/nyxta.png",["style"=>"max-height: 80%; padding: 0;position:relative;"]).'</span>',
    // 'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-lg navbar-dark bg-dark text-light shadow',
        //'style'=>"background-color: #e3f2fd;"

    ],
]);  ?>


<div class="container-fluid">
    <?php
    $menuItems = [
        [
            'label' => Yii::t('app', 'Home'),
            'url' => ['/'],
            'active' => in_array(Yii::$app->controller->id, ['site']) && in_array(Yii::$app->controller->action->id, ['index']),
            'linkOptions' => [
                'class' => in_array(Yii::$app->controller->id, ['site']) && in_array(Yii::$app->controller->action->id, ['index']) ? 'nav-item nav-link text-white ml-3' : 'nav-item nav-link text-white',
            ],
        ],
        [
            'label' => Yii::t('app', 'Browse'),
            //'url' => ['/category/index'],
            'url' => ["#"], //nav-link dropdown-toggle show 
            'options' => ['class' => 'has-megamenu'],
            //class="dropdown-toggle" data-toggle="dropdown"
            'linkOptions' => ['class' => 'dropdown-toggle', 'data-bs-auto-close' => 'outside', 'data-bs-toggle' => 'dropdown'],
            // 'active' => in_array(Yii::$app->controller->id, ['category', 'product']),
            'items' => [
                $this->render("_mega")
            ]
        ],
        ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog']],

    ];
    ?>
    <div class="col-auto me-auto">
        <?= Nav::widget([
            'options' => ['class' => "xtop-nav"],
            'items' => $menuItems,
        ]); ?>
    </div>
</div> <!-- container-fluid -->
<?php NavBar::end();   ?>
<!-- Navbar ends -->
<?php if (Yii::$app->controller->id !== 'site' || Yii::$app->controller->action->id !== 'index') : ?>
    <div class="p-5 bg-primary bs-cover" style="background-image: url(<?= '/image/site/Banner_1.webp'; ?>);">
        <div class="container text-center">
            <span class="display-5 px-3 bg-white rounded shadow">Bracelets</span>
        </div>
    </div>
<?php endif;  ?>
<?php
if (isset($this->params['breadcrumbs'])) {
    echo Html::tag(
        'div',
        Breadcrumbs::widget([
            'links' => $this->params['breadcrumbs'],
            'homeLink' => [
                'label' => Yii::$app->name,
                'url' => Yii::$app->homeUrl,
            ],
        ]),
        [
            'class' => 'bg-grey'
        ]
    );
}
?>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" alt="">
            <img src="img/logo-2.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="my_toggle_menu">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="dropdown submenu active">
                    <a class="dropdown-toggle" href="index.php" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                </li>
                <li><a href="/products/cakes">Our Cakes</a></li>
                <li class="dropdown submenu">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Cake Category</a>
                    <ul class="dropdown-menu">
                        <li><a href="category-details.php?catname=Eggless Cake">Eggless Cake</a></li>
                        <li><a href="category-details.php?catname=Kids Cake">Kids Cake</a></li>
                        <li><a href="category-details.php?catname=Photo Cake">Photo Cake</a></li>
                        <li><a href="category-details.php?catname=Premium Cake">Premium Cake</a></li>
                        <li><a href="category-details.php?catname=Cup Cake">Cup Cake</a></li>
                        <li><a href="category-details.php?catname=First Birthday Cake">First Birthday Cake</a></li>
                        <li><a href="category-details.php?catname=Midnight Cake">Midnight Cake</a></li>
                        <li><a href="category-details.php?catname=First Anniversary Cake">First Anniversary Cake</a>
                        </li>
                        <li><a href="category-details.php?catname=abc">abc</a></li>
                    </ul>
                </li>
                <li><a href="about-us.php">About Us</a></li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li><a href="registration.php">Sign up</a></li>
                <li><a href="login.php">Sign in</a></li>
                <li><a href="track-order.php">Track Order</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    </nav>
</div>