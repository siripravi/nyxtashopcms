<?php

use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?php
$menuItems = []; //<iconify-icon icon="mdi:user-outline" style="color: #123;" width="20" rotate="0deg"></iconify-icon>
if (Yii::$app->user->isGuest) {
    $menuItems[] = [
        'label' =>  Html::tag(
            'span',
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 2a2 2 0 0 0-2 2a2 2 0 0 0 2 2a2 2 0 0 0 2-2a2 2 0 0 0-2-2m0 7c2.67 0 8 1.33 8 4v3H4v-3c0-2.67 5.33-4 8-4m0 1.9c-2.97 0-6.1 1.46-6.1 2.1v1.1h12.2V17c0-.64-3.13-2.1-6.1-2.1Z"></path></svg>',
            ["class" => "d-inline-block", "tabindex" => "0", "data-bs-toggle" => "popover", "data-bs-trigger" => "hover focus", "data-bs-content" => "click to login!"]
        ),
        'encode' => false,
        'url' => ['/site/login'],
        'linkOptions' => ['alt' => Yii::t('app', 'Login'), 'class' => ''],
    ];
} else {
    $menuItems[] = [
        'label' => Yii::t('app', 'Manage users'),
        'url' => ['/user/index'],
        'visible' => \Yii::$app->user->can('manage_users'),
        'items' => []
    ];
    $menuItems[] = [
        'label' => Html::img(
            Yii::$app->user->identity->getAvatarImage(),
            ['alt' => Yii::$app->user->identity->username, 'class' => 'rounded-circle border-2', 'width' => 38]
        ),
        'encode' => false,
        'linkOptions' => ['alt' => Yii::t('app', 'Welcome'), 'data-bs-title' => Yii::t('app', 'Welcome'), 'class' => ''],
        'items' => [
            [
                'label' => Html::tag('span', Yii::$app->user->identity->username),
                'url' => ['/user/view', 'id' => \Yii::$app->user->id],
                'encode' => false,
            ],
            [
                'label' => Html::tag('span', Yii::t('app', 'Bookmarks')),
                'encode' => false,
                'url' => ['/project/bookmarks'],
                'linkOptions' => ['alt' => Yii::t('app', 'Bookmarks'), 'title' => Yii::t('app', 'Bookmarks')],
            ],
            [
                'label' => Html::tag('span', Yii::t('app', 'Logout')),
                'url' => ['/site/logout'],
                'encode' => false,
                'linkOptions' => [
                    'data-method' => 'post',
                    'alt' => Yii::t('app', 'Logout'),
                    'title' => Yii::t('app', 'Logout'),
                ],
            ]
        ]
    ];
}

?>
<!-- Begin Top Nav -->
<div class="col-12 bg-dark py-2 d-md-block d-none">
    <div class="row">
        <div class="col-auto me-auto">
            <ul class="top-nav">
                <li>
                    <a href="tel:+123-456-7890"><i class="fa fa-phone-square me-2"></i>+123-456-7890</a>
                </li>
                <li>
                    <a href="mailto:mail@ecom.com"><i class="fa fa-envelope me-2"></i>mail@ecom.com</a>
                </li>
            </ul>
        </div>
        <div class="col-auto">
            <!--<ul class="top-nav d-inline-flex ps-4">
                <li>
                    <a href="register.html"><i class="fas fa-user-edit me-2"></i>Register</a>
                </li>
                <li>
                    <a href="login.html"><i class="fas fa-sign-in-alt me-2"></i>Login</a>
                </li>
            </ul> -->
            <?= Nav::widget([
            'options' => ['class' => "top-nav d-inline-flex ps-4"],
            'items' => $menuItems,
        ]); ?>

            <div class="d-inline-flex ps-4">
                <?= Html::a('<img src="/image/site/flag-us.svg">', Url::current(['lang' => 'en']), ['class' => ['btn btn-sm', Yii::$app->language === 'en' ? '' : ''], 'hreflang' => 'us-EN', 'rel' => 'nofollow']) ?>
                <?= Html::a('<img src="/image/site/flag-bha.svg">', Url::current(['lang' => 'hi']), ['class' => ['btn btn-sm', Yii::$app->language === 'hi' ? '' : ''], 'hreflang' => 'hi-IN', 'rel' => 'nofollow']) ?>
            </div>
        </div>
    </div>
</div>
<!-- End Top Nav -->