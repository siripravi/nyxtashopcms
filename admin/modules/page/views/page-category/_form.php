<?php
/**
 * Project: yii2-blog for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\models\PageCategory;
use admin\modules\page\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\modules\blog\models\BlogCategory */
/* @var $form yii\widgets\ActiveForm */

//fix the issue that it can assign itself as parent
$parentCategory = ArrayHelper::merge([0 => Yii::t('page', 'Root Category')], ArrayHelper::map(PageCategory::get(0, PageCategory::find()->all()), 'id', 'str_label'));
unset($parentCategory[$model->id]);

?>

<div class="blog-category-form">
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-10\">{input}{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>
    <div class="card card-info review-form">
            <div class="card-header d-flex">           
            <?= Html::submitButton($model->isNewRecord ? Yii::t('page', 'Create') : Yii::t('page', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block bg-gradient-secondary btn-sm' : 'btn btn-block bg-gradient-secondary btn-sm']) ?>       
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'parent_id')->dropDownList($parentCategory) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 128]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'page_size')->textInput() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'banner')->fileInput() ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'is_nav')->dropDownList(PageCategory::getArrayIsNav()) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'sort_order')->textInput() ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'template')->textInput(['maxlength' => 255]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'redirect_url')->textInput(['maxlength' => 255]) ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'status')->dropDownList(PageCategory::getStatusList()) ?>
                    </div>
                </div>                
            </div>
        </div>   
    <?php ActiveForm::end(); ?>
</div>
