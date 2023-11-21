<?php 

use dosamigos\ckeditor\CKEditor;
?>    
	
	<?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'h1' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'title' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords' . $suffix)->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description' . $suffix)->textarea() ?>
    
    <?= $form->field($model, 'text' . $suffix)->widget(CKEditor::class, [
                    'preset' => 'full',
                    'clientOptions' => [
                        'customConfig' => '/js/ckeditor.js',
                        'language' => Yii::$app->language,
                        'allowedContent' => true,
                    ]
                ]) ?>