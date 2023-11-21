<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\PasswordResetRequestForm */

$this->title = Yii::t('app', 'Request password reset');
?>
<div class="row">
    <div class="col-12 mt-3 text-center text-uppercase">
        <h2><?=$this->title;?></h2>
        <p><?= Yii::t('app', 'Please fill out your email. A link to reset password will be sent there.') ?></p>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
<main class="row">
    <div class="col-12"> 
    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <div class="mb-3">
            <?= $form->field($model, 'email')
            ->textInput(['placeholder' => $model->getAttributeLabel('email')])
            ->label(false) ?>
        </div>
        <div class="mb-3">        
            <?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</main>
</div>
