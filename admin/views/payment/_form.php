<?php

use app\admin\models\Payment;
use admin\modules\language\models\Language;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\admin\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>

<div class="card  border-secondary mb-3 col-6">
    <div class="card-header d-flex p-1">
        <div class="card-title p-3">Fill the Info</div>
        <ul class="nav nav-tabs  nav-fill ml-auto p-0">
            <li class="nav-item"><a href="#main-tab" class="nav-link" data-bs-toggle="tab">Main</a></li>
            <?php foreach (Language::suffixList() as $suffix => $name) : ?>
                <li class="nav-item"><a href="#lang<?= $suffix ?>" class="nav-link <?= empty($suffix) ? ' active': '' ?>" data-bs-toggle="tab"><?= $name ?></a></li>
            <?php endforeach; ?>
            
        </ul>
        <div class="form-groupd-grid gap-2 col-4 mx-auto pt-3">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-info']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="main-tab">
                <?= $form->field($model, 'type')->dropDownList(Payment::typeList()) ?>
                <?= $form->field($model, 'enabled')->checkbox() ?>
            </div>
            <?php foreach (Language::suffixList() as $suffix => $name) : ?>
                <div class="tab-pane fade" id="lang<?= $suffix ?>">
                    <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'text' . $suffix)->widget(CKEditor::class, [
                        'preset' => 'full',
                        'options' => [
                            'id' => 'pagetext' . $suffix,
                        ],
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                        ]
                    ]) ?>
                </div>
            <?php endforeach; ?>
        </div>    
    </div>
</div>
<?php ActiveForm::end(); ?>


