<?php

use app\modules\language\models\Language;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>



    <?php $form = ActiveForm::begin(); ?>
    <div class="card card-secondary setting-form">
    <div class="card-header">
            <div class="card-title ">
                
            </div>
            <div class="card-tools">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>    
        </div>
        <div class="card-body">
    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <div class="row col-12">
    <?php foreach (Language::suffixList() as $suffix => $name) : ?>
        <div class="card card-info col-6 p-2">
            <div class="card-header">
                <div class="card-title ">
                    <h5><?= $name; ?></h5>
                </div>
                <div class="card-tools">
                
                </div>    
            </div>
            <div class="card-body">
                <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>        
                <?= $form->field($model, 'value' . $suffix)->textarea(['rows' => 6]) ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    </div>
    </div>
    <?php ActiveForm::end(); ?>


