<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\ResetPasswordForm */

$this->title = Yii::t('app', 'Reset password');
?>
<div class="row">
    <div class="col-12 mt-3 text-center text-uppercase">
        <h2><?=$this->title;?></h2>
        <p><?= Yii::t('app', 'Please choose your new password:') ?></p>
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
<main class="row">
    <div class="col-12"> 
        <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
        <?= $form->field($model, 'password')
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
            ->label(false) ?>
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</main>
</div>