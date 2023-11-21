<?php
use yii\widgets\Pjax;
use admin\modules\image\widgets\ImagesForm;
?>

<?= ImagesForm::widget([
                    'images' => $images,
                    'image_id' => $model->image_id,
                    'imageEnabled' => $model->imageEnabled,
                    'col' => 'col-md-4',
                    'size' => 'fill',
                    'label' => null,
                    'modelInputName' => $model->formName(),
]) ?>