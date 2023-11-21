<?php 

use dosamigos\ckeditor\CKEditor;
use admin\modules\products\models\Category;
use admin\modules\products\models\Brand;
use admin\modules\products\models\Status;
use kartik\select2\Select2;
?>
            <?= $form->field($model, 'category_ids')->widget(Select2::class, [
                'data' => Category::getList(null),
                'options' => [
                    'placeholder' => Yii::t('app', 'Select'),
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'showToggleAll' => false,
            ]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'brand_id')->dropDownList(Brand::getList(true), ['prompt' => '']) ?>

            <?= $form->field($model, 'status_ids')->checkboxList(Status::getList(null)) ?>

            <?= $form->field($model, 'view')->dropDownList(['container' => 'container', 'accessory' => 'accessory'], ['prompt' => '']) ?>

            <?= $form->field($model, 'price_from')->checkbox() ?>

            <?= $form->field($model, 'enabled')->checkbox() ?>
