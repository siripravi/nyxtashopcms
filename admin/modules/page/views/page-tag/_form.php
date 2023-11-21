<?php
/**
 * Project: yii2-blog for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\PageTag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-tag-form">
    <div class="row">
        <div class="col-6">
            <?php $form = ActiveForm::begin(); ?>
                <div class="card card-info review-form">
                    <div class="card-header d-flex">           
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('page', '<i class="fas fa-plus"></i>&nbsp;&nbsp;Create') : Yii::t('page', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block bg-gradient-secondary btn-sm' : 'btn btn-block bg-gradient-secondary btn-sm']) ?>     
                    </div>
                    <div class="card-body">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>
                        <?= $form->field($model, 'frequency')->textInput(['maxlength' => 10]) ?>
                        
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>    
</div>
