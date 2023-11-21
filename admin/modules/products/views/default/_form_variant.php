<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 20.05.17
 * Time: 17:54
 *
 * @var $this yii\web\View
 * @var $form yii\bootstrap5\ActiveForm
 * @var $modelVariant admin\modules\products\models\Variant
 * @var $index integer
 */

use admin\modules\products\models\Currency;
use admin\modules\products\models\Unit;
use admin\modules\language\models\Language;
use yii\helpers\Html;

?>
<?php
if (!$modelVariant->isNewRecord) {
    echo Html::activeHiddenInput($modelVariant, "[{$index}]id");
}
?>

<div class="card card-default">
    <div class="card-header">
        <div class="card-title">
            <?= Html::button("<i class='fas fa-trash'></i>", ['class' => 'btn btn-default remove-variant']) ?>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php foreach (Language::suffixList() as $suffix => $name): ?>
                <div class="col-md-12">
                    <?= $form->field($modelVariant, '[' . $index . ']name' . $suffix)->textInput(['maxlength' => true]) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="col-6">
                <?= $form->field($modelVariant, '[' . $index . ']price')->textInput(['style' => 'width:220px;']) ?>
                <?= $form->field($modelVariant, '[' . $index . ']price_old')->textInput(['style' => 'width:220px;']) ?>
            </div>
            <div class="col-6">
                <?= $form->field($modelVariant, '[' . $index . ']currency_id')->dropDownList(Currency::getList(true), ['style' => 'width:120px;']) ?>
                <?= $form->field($modelVariant, '[' . $index . ']unit_id')->dropDownList(Unit::getList(true)) ?>
            </div>
        </div>
        <div class="row">
            <?= $form->field($modelVariant, '[' . $index . ']code')->textInput(['maxlength' => true,['style' => 'width:220px;']]) ?>
            <?= $form->field($modelVariant, '[' . $index . ']available')->textInput(['style' => 'width:220px;'])->label($modelVariant->getAttributeLabel('available') . ' <i class="bi bi-question" data-bs-toggle="tooltip" title="(1) In Stock, (0) Out of Stock, (-1) On Order"></i>') ?>

        </div>

        <div class="row">
            <div class="col-6 p-4 text-right">
                <?= $form->field($modelVariant, '[' . $index . ']enabled')->checkbox() ?>
            </div>
        </div>
    </div>
</div>