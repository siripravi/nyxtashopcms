<?php

use admin\modules\language\models\Language;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Brand */
/* @var $form yii\bootstrap5\ActiveForm */
?>
    <?php $form = ActiveForm::begin(); ?>
<div class="card">
<div class="card-header d-flex p-1">
<p class="card-title p-0"><h4>Brand Info</h4></p>
</div>
 <div class="card-body">

    <?php foreach (Language::suffixList() as $suffix => $name) : ?>
        <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
    <?php endforeach; ?>

    <?= $form->field($model, 'image_id')->textInput() ?>

    <?= $form->field($model, 'enabled')->checkbox() ?>

    <div class="card-footer">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

 </div>
</div>
<?php ActiveForm::end(); ?>