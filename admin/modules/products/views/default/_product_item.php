<?php
use app\modules\main\widgets\PriceTable;
use admin\modules\image\helpers\ImageHelper;
use yii\bootstrap5\Dropdown;
use yii\bootstrap5\Button;
use yii\helpers\Url;
use yii\helpers\Html;

$variant = @$model->variants[0];

if (@$model->variants[0]->price) {
    $available = 0;
    foreach ($model->variants as $variant) {
        if ($variant->enabled) {
            if ($variant->available < 0) {
                $available = -1;
            }
            if ($variant->available > 0) {
                $available = 1;
                break;
            }
        }
    }
}
?>

<div class="card text-center mb-4" style="width:14rem">
    <?php if ($model->image) { ?>
        <img src="<?= ImageHelper::thumb($model->image->id, 'micro') ?>"
            alt="<?= $model->image->alt ? $model->image->alt : $model->name ?>" title="<?= $model->title ?>"
            class="card-img ">
    <?php } else { ?>
        <img class="card-img" src="<?= Yii::$app->params['image']['none'] ?>" alt="">
    <?php } ?>
    <div class="card-img-overlay" style="height:80%">
        <h5 class="card-title text-white bg-info text-wrap text-break bd-highlight">
            <?= $model->name; ?>
        </h5>
        <div class="card-subtitle">
            In <?= $model->categories[0]->shortTitle; ?>
        </div>
        <p>
            <?php echo $model->variants[0]->price; ?>
        </p>
        </div>
    <div class="card-footer">
        <?php
        /*echo Button::widget([
            'label' => 'Edit',
            'options' => ['class' => 'btn btn-primary'],
        ]);*/
        echo Html::a("Edit", Url::to('/admin/products/default/update?id=' . $model->id), ['class' => 'card-link']);
        ?>

    </div>
    <?php
    /* echo Dropdown::widget([
         'items' => [
             ['label' => 'DropdownA', 'url' => '/'],
             ['label' => 'DropdownB', 'url' => '#'],
         ],
     ]);*/
    ?>
    
</div>