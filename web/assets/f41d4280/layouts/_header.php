<?php

use luya\helpers\Html;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['uname'])) {
    $href = 'checkAccount.php';
    $icon = 'bx bxs-user-circle';
    $cartHref = 'cart.php';
} else {
    $href = 'login.php';
    $icon = 'bx bx-user-circle';
    $cartHref = 'login.php';
}

$page = "index";
?>

<header class="<?php if ($page == 'index' || $page == 'products') {
                    echo 'indexNav';
                } ?> main-header-media1200">

    <div class="hamburger-menu">
        <i class="fas fa-bars toggle"></i>
        <i class="fas fa-times toggle"></i>
    </div>

    <nav class="d-flex align-items-center justify-content-center justify-content-lg-between">
        <a class="navbar-brand" href="index.html">
            <img class="img-fluid" src="/image/new/logo.png" alt='logo'>
        </a>
        <ul class="nav-list text-center p-0">
            <!--<li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#chef">Our Team</a>
                    </li>  -->
            <?php foreach (Yii::$app->menu->find()->container('default')->root()->all() as $item) : ?>
                <li class="<?php echo $item->isActive ? 'active' : '' ?>">
                    <?php if ($item->hasChildren) : ?>
                        <?php echo Html::a($item->title, $item->link, ['class' => $item->alias == Yii::$app->menu->current->alias]) ?>

                        <ul>
                            <?php foreach ($item->children as $childItem) : ?>
                                <li>
                                    <?php echo Html::a($childItem->title, $childItem->link, ['class' => $childItem->alias == Yii::$app->menu->current->alias]) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <?php echo Html::a($item->title, $item->link, ['class' => $item->alias == Yii::$app->menu->current->alias]) ?>
                    <?php endif ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    </div>
</header>