<?php foreach (Yii::$app->menu->find()->container('default')->root()->all() as $item) : ?>
    <li class="<?php echo $item->isActive ? 'nav-item active' : 'nav-item' ?>">
        <?php if ($item->hasChildren) : ?>
            <?php echo Html::a($item->title, $item->link, ['class' => $item->alias == Yii::$app->menu->current->alias]) ?>

            <ul>
                <?php foreach ($item->children as $childItem) : ?>
                    <li class="nav-item">
                        <?php echo Html::a($childItem->title, $childItem->link, ['class' => $childItem->alias == Yii::$app->menu->current->alias]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <?php echo Html::a($item->title, $item->link, ['class' => $item->alias == Yii::$app->menu->current->alias]) ?>
        <?php endif ?>
    </li>
<?php endforeach; ?>