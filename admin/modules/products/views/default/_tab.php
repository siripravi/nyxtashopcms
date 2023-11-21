<?php 

use dosamigos\ckeditor\CKEditor;


?>    
	<!--?= $form->field($model, 'name')->widget(\yii\bootstrap5\ToggleButtonGroup::class, [
      'type' => \yii\bootstrap5\ToggleButtonGroup::TYPE_CHECKBOX,
      'items' => [
          'fooValue' => 'BarLabel',
          'barValue' => 'BazLabel'
      ]
  ]) ?-->
	<?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'h1' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description' . $suffix)->textarea() ?>
    <?php
    if (isset($model->text_short)) {
               echo $form->field($model, 'text_short' . $suffix)->widget(CKEditor::class, [
           'preset' => 'full',
                 'clientOptions' => [
                     'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
    ?>
    <?= $form->field($model, 'text' . $suffix)->widget(CKEditor::class, [
                    'preset' => 'full',
                    'clientOptions' => [
                        'customConfig' => '/js/ckeditor.js',
                        'language' => Yii::$app->language,
                        'allowedContent' => true,
                    ]
                ]) ?>
    <?php
                if (isset($model->text_features)) {
                    echo $form->field($model, 'text_features' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
    <?php
                if (isset($model->text_tips)) {
                    echo $form->field($model, 'text_tips' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
    <?php
                if (isset($model->text_process)) {
                    echo $form->field($model, 'text_process' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
    <?php
                if (isset($model->text_use)) {
                    echo $form->field($model, 'text_use' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
    <?php
                if (isset($model->text_storage)) {
                    echo $form->field($model, 'text_storage' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
    <?php
                if (isset($model->text_top)) {
                    echo $form->field($model, 'text_top' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]);
                }
                ?>
 