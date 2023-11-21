<?php

use dosamigos\ckeditor\CKEditor;
use admin\modules\products\models\Category;

use admin\modules\products\models\Status;

?>
  <?= $form->field($model, 'parent_id')
        ->dropDownList(Category::getList(true), [
            'prompt' => '',
            'options' => [
                $model->id => [
                    'disabled' => true,
                ],
            ],
        ]) ?>
    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'enabled')->checkbox() ?>
    <?= $form->field($model, 'main')->checkbox() ?>