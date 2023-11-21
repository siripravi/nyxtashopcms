<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model dench\cart\models\Buyer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buyer-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card-actions ml-auto p-2 text-right">
        <?= Html::submitButton(Yii::t('app', '<i class="fas fa-save"></i>&nbsp;Save'), ['class' => 'btn btn-block bg-gradient-primary']) ?>
    </div>  
    <div class="card card-warning card-tabs">
        <div class="card-body">           
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                'mask' => '+99 (999) 999-99-99',
            ]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'entity')->checkbox() ?>
            <?= $form->field($model, 'delivery')->textInput(['maxlength' => true]) ?>   
          
        </div>
    </div>    
    <?php ActiveForm::end(); ?>

</div>
