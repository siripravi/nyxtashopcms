<?php
/**
 * Project: yii2-blog for internal using
 * Author: common\modules
 * Copyright (c) 2018.
 */

use common\modules\blog\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>


    <?php $form = ActiveForm::begin([
        'id' => 'comment-form',
    ],['class'=>'mb-4']); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'author')->textInput((['maxlength' => 32])); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput((['maxlength' => 32])); ?>
        </div>
    </div>

    <?= $form->field($model, 'content')->textarea(['rows' => 3]); ?>

    <?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::class, [
        'captchaAction' => \yii\helpers\Url::to('/page/default/captcha'),
    ])->hint(Yii::t('page', 'Math, for example, 45-12 = 33')) ?>

    <?= Html::submitButton(Yii::t('page', 'Add comments'), ['class' => 'btn btn-primary']) ?>

    <?php ActiveForm::end(); ?>

