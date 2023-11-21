<?php

use admin\modules\products\models\Product;
use admin\modules\language\models\Language;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Complect */
/* @var $form yii\bootstrap5\ActiveForm */
?>
<div class="row">
    <div class="col-8 feature-form">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card card-secondary card-tabs">
            <div class="card-header ">
                <div class="card-title col-10">
                </div>
                <div class="card-actions ml-auto p-2 text-right">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-flat btn-outline btn-primary' : 'btn btn-flat btn-outline btn-primary']) ?>
                </div>    
            </div>

            <div class="card-body">
                <div class="row">
                    <?php foreach (Language::suffixList() as $suffix => $name) : ?>
                        <div class="col-6">
                            <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?= $form->field($model, 'product_ids')->dropDownList(Product::getList(null), [
                    'multiple' => true,
                    'size' => 15,
                ]) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
