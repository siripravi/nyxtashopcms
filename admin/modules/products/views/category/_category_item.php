<?php

use app\modules\main\widgets\PriceTable;
use admin\modules\image\helpers\ImageHelper;
use yii\bootstrap5\Dropdown;
use yii\bootstrap5\Button;
use yii\helpers\Url;
use yii\helpers\Html;

?>

    <div class="card my-3 w-50">
        <div class="card-thumbnail">
            <?php $image = $model->getImage()->one();  ?>
            <?php if ($image) { ?>
                <img src="<?= ImageHelper::thumb($image->id, 'micro') ?>" alt="<?= $image->alt ? $model->image->alt : $model->name ?>" title="<?= $model->title ?>" class="card-img rounded-circle">
            <?php } else { ?>
                <img class="img-fluid" src="<?= Yii::$app->params['image']['none'] ?>" alt="">
            <?php } ?>

        </div>
        <div class="card-body">
            <h3 class="card-title">
                <?php echo Html::a($model->name, ['/admin/products/default/index', 'ProductSearch[category_id]' => $model->id]); ?>
            </h3>
            <p class="text-secondary><?= $model->shortTitle; ?></p>
                        <p class=" card-text">...</p>
            <?php
            echo Html::a("Edit", Url::to('/admin/products/category/update?id=' . $model->id), ['class' => 'btn btn-warning']);
            ?>
        </div>
    </div>
