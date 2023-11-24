<!--Header-->
<div id="header">
    <div class="container">
        <ul class="list-inline text-right hidden-xs">
            <li class="list-inline-item"><a href="#!home">home</a></li>
            <li class="list-inline-item"><a href="#!products/" data-scrollto="types">products</a></li>
        </ul>

        <a class="logo">
            <img src="/image/site/logo.png" alt="" width="67" height="121" class="hidden-xs">
            <!--<img src="/image/site/logo.png" alt="" width="138" height="248" class="visible-xs">-->
        </a>

        <ul class="list-inline right hidden-xs">
            <li class="list-inline-item"><a href="#" data-scrollto="about-section">our story</a></li>
            <li class="list-inline-item"><a href="#" data-scrollto="footer-wrapper">find us</a></li>
        </ul>
    </div>
</div>

<!-- end Header-->

<div id="xheader">
    <div class="container">
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
    </div>
</div>

<!-- end Header-->