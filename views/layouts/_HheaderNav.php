<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\icons\Icon;
use yii\bootstrap5\Nav;
use app\modules\cart\widgets\CartIconWidget;
use app\modules\cart\widgets\CartWidget;
?>
<!-- Header -->
<div class="col-12 bg-white pt-4">
    <div class="row">
        <div class="col-lg-auto">
            <div class="site-logo text-center text-lg-left">
                <a href="index.html">Nyxta Shop</a>
            </div>
        </div>
        <div class="col-lg-5 mx-auto mt-4 mt-lg-0">
            <form action="#">
                <div class="form-group">
                    <div class="input-group">
                        <input type="search" class="form-control border-dark" placeholder="Search..." required>
                        <button class="btn btn-outline-dark"><?php echo Icon::show('search', ['class' => '', 'framework' => Icon::FAS]); ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <!--?php
                 Popover::begin([
                     'title' => 'Hello world',
                     'toggleButton' => ['label' => 'click me'],
                 ]);
                
                 echo 'Say hello...';
                
                 Popover::end();
            ?-->

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

            <div class="btn-group">
                <?= Nav::widget([
                    'options' => ['class' => 'xtop-nav'],
                    'items' => $menuItems,
                ]); ?>
            </div>
            <div class="col-lg-4 text-center text-lg-left header-item-holder fa-2x">
                <!--<a href="#" class="header-item">
                <i class="fas fa-heart me-2"></i><span id="header-favorite">0</span>
            </a> -->
                <?= CartIconWidget::widget();  ?>
                <!--<a href="cart.html" class="header-item">
                <i class="fas fa-shopping-bag me-2"></i><span id="header-qty" class="me-3">2</span>
                <i class="fas fa-money-bill-wave me-2"></i><span id="header-price">$4,000</span>
            </a> -->
            </div>

        </div>

        <!-- Nav -->
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
                <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="electronics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Electronics</a>
                            <div class="dropdown-menu" aria-labelledby="electronics">
                                <a class="dropdown-item" href="category.html">Computers</a>
                                <a class="dropdown-item" href="category.html">Mobile Phones</a>
                                <a class="dropdown-item" href="category.html">Television Sets</a>
                                <a class="dropdown-item" href="category.html">DSLR Cameras</a>
                                <a class="dropdown-item" href="category.html">Projectors</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="fashion" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Fashion</a>
                            <div class="dropdown-menu" aria-labelledby="fashion">
                                <a class="dropdown-item" href="category.html">Men's</a>
                                <a class="dropdown-item" href="category.html">Women's</a>
                                <a class="dropdown-item" href="category.html">Children's</a>
                                <a class="dropdown-item" href="category.html">Accessories</a>
                                <a class="dropdown-item" href="category.html">Footwear</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="books" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Books</a>
                            <div class="dropdown-menu" aria-labelledby="books">
                                <a class="dropdown-item" href="category.html">Adventure</a>
                                <a class="dropdown-item" href="category.html">Horror</a>
                                <a class="dropdown-item" href="category.html">Romantic</a>
                                <a class="dropdown-item" href="category.html">Children's</a>
                                <a class="dropdown-item" href="category.html">Non-Fiction</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Nav -->
    </div>
    <!-- Header -->