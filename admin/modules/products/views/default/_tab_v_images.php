<?php
use yii\widgets\Pjax;
use admin\modules\image\widgets\ImagesForm;
?>

<div class="row-fluid">
    <?php Pjax::begin(['id' => 'images-pjax']); ?>
    <?php foreach ($variantImages as $index => $images) : ?>
    <div class="variant-images">
        <?= ImagesForm::widget([
            'images' => $images,
            'image_id' => @$modelsVariant[$index]->image_id,
            'imageEnabled' => @$modelsVariant[$index]->imageEnabled,
            'col' => 'col-sm-4 col-md-3',
            'size' => 'fill',
            'modelInputName' => 'Variant[' . $index . ']',
            'fileInputName' => 'files' . $index,
            'label' => null,
        ]) ?>
    </div>
    <?php endforeach; ?>
    <?php Pjax::end(); ?>
</div>