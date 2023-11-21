<?php

use admin\modules\language\models\Language;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Status */
/* @var $form yii\bootstrap5\ActiveForm */
?>

<div class="row">
    <div class="col-6">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
    <div class="card border-primary mb-3">
        <div class="d-grid gap-2 col-4 mx-auto pt-3">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-flat btn-outline btn-primary' : 'btn btn-flat btn-outline btn-primary']) ?>
        </div>       
  
    <div class="card-body">
        <?php foreach (Language::suffixList() as $suffix => $name) : ?>
            <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
        <?php endforeach; ?>

        <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'enabled')->checkbox() ?>

    </div>
</div>
    <?php ActiveForm::end(); ?>
 
        </div>
</div>