<?php

use admin\modules\products\models\Feature;
use admin\modules\language\models\Language;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Value */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $modal boolean */
?>

<div class="card-body">
    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),'layout' => 'horizontal'
    ]); ?>

    <!--php if (!$modal) : ?-->
        <?= $form->field($model, 'feature_id')->dropDownList(Feature::getList(true, []), ['prompt' => '']) ?>
    <!--php endif; ?-->

    <?php foreach (Language::suffixList() as $suffix => $name) : ?>
        <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
if ($modal) {
    $script = <<< JS
$('#{$model->formName()}').on('beforeSubmit', function(e){
    var form = $(this);
    $.ajax({
        url: form.attr("action"),
        type: "post",
        data: form.serialize(),
        success: function (response) {
            console.log(response);
            if (response == 'success') {
                $('#modal-value').modal('hide');
                $.pjax.reload({container: '#pjax-grid-values'});
            }
        },
        error: function () {
            console.log("internal server error");
        }
    });
    return false;
});
JS;
    Yii::$app->view->registerJs($script);
}
?>
