<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\SignupForm */

$this->title = Yii::t('app', 'Signup');
?>
<div class="row">
    <div class="col-12 mt-3 text-center text-uppercase">
        <h2><?=$this->title;?></h2>       
    </div>
</div>
<div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
<main class="row">
    <div class="col-12"> 
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username')
                    ->textInput(['placeholder' => $model->getAttributeLabel('username')])
                    ->label(false) ?>
                <?= $form->field($model, 'email')
                    ->textInput(['placeholder' => $model->getAttributeLabel('email')])
                    ->label(false) ?>
                <?= $form->field($model, 'password')
                    ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
                    ->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'signup-button', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            <div class="divider">
            <?= Yii::t('app', 'or') ?>
        </div>

        <div class="oauth-box">
            <?= \app\widgets\AuthChoice::widget([
                'options' => ['class' => 'auth-clients-wrapper'],
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => false,
            ]) ?>
        </div>    
    </div>
</main>
</div>
