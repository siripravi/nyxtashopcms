<?php
use yii\widgets\Pjax;
use yii\base\Widget;
use yii\helpers\Html;
use kartik\widgets\Select2;
use admin\modules\products\models\Value;
?>

<?php Pjax::begin(['id' => 'feature-pjax']); ?>
    <?php Widget::$autoIdPrefix = 'f'; ?>
        <?php if (empty($features)) : ?>
            <?= Html::tag('div', Yii::t('app', 'Select a category!'), ['class' => 'alert alert-danger']) ?>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th><?= Yii::t('app', 'Name') ?></th>
                            <?php foreach ($modelsVariant as $index => $modelVariant) : ?>
                                <td><?= $modelVariant->name ?></td>
                            <?php endforeach; ?>                            
                        </tr>
                            <?php foreach ($features as $feature) : ?>
                                <tr>
                                    <td><?= $feature->name . ($feature->after ? ', ' . $feature->after : '') ?></td>
                                    <?php foreach ($modelsVariant as $index => $modelVariant) : ?>
                                        <td>
                                            <?php
                                            $value_ids = [];
                                            $list = Value::getList($feature->id);
                                            foreach ($modelVariant->value_ids as $value_id) {
                                                if (isset($list[$value_id])) {
                                                    $value_ids[] = $value_id;
                                                }
                                            }
                                            ?>
                                            <?= Select2::widget([
                                                'name' => 'Variant[' . $index . '][value_ids][]',
                                                'data' => $list,
                                                'value' => $value_ids,
                                                'size' => Select2::SMALL,
                                                'options' => ['placeholder' => Yii::t('app', 'Select'), 'multiple' => true],
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                                'showToggleAll' => false,
                                                //'pjaxContainerId' => 'feature-pjax',
                                            ]) ?>
                                        </td>
                                <?php endforeach; ?>
                            </tr>
                     <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
   <?php Widget::$autoIdPrefix = 'w'; ?>
 <?php Pjax::end(); ?>
