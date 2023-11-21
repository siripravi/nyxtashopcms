<?php

use admin\modules\products\models\Category;
use admin\modules\language\models\Language;
use admin\modules\sortable\grid\SortableColumn;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Feature */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $values admin\modules\products\models\Value[] */
?>
<?php $form = ActiveForm::begin(); ?>


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-8 justify-content-start">
                <ul class="nav nav-tabs gap-1  nav-fill">
                    <?php foreach (Language::suffixList() as $suffix => $name): ?>
                        <li class="nav-item"><a href="#lang<?= $suffix ?>"
                                class="nav-link <?= empty($suffix) ? ' active' : '' ?>" data-bs-toggle="tab">
                                <?= $name ?>
                            </a></li>
                    <?php endforeach; ?>
                    <li class="nav-item"><a href="#main-tab" class="nav-link" data-bs-toggle="tab">Main</a></li>
                </ul>
            </div>
            <div class="col-4 justify-content-end">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn  btn-info' : 'btn btn-info']) ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <?php foreach (Language::suffixList() as $suffix => $name): ?>
                <div class="tab-pane fade<?php if (empty($suffix))
                    echo ' show active'; ?>" id="lang<?= $suffix ?>">
                    <?= $form->field($model, 'name' . $suffix)->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'after' . $suffix)->textInput(['maxlength' => true]) ?>
                </div>
            <?php endforeach; ?>
            <div class="tab-pane fade" id="main-tab">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'category_ids')->checkboxList(Category::getList(true)) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'filter_ids')->checkboxList(Category::getList(true)) ?>
                    </div>
                </div>
                <div class="card-footer justify-content-end">
                    <?= $form->field($model, 'enabled')->checkbox() ?>
                </div>
            </div>
            <div class="tab-pane fade" id="values-tab">
                <p>
                    <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Value')), ['value/create', 'feature_id' => $model->id], ['class' => 'btn btn-success modal-value-open']) ?>
                </p>
                <?php Pjax::begin([
                    'id' => 'pjax-grid-values',
                ]) ?>
                <?= GridView::widget([
                    'dataProvider' => $values,
                    'rowOptions' => function ($model, $key, $index, $grid) {
                        return [
                            'data-position' => $model->position,
                        ];
                    },
                    'columns' => [
                        [
                            'class' => SortableColumn::class,
                        ],
                        'name',
                        'feature.after',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'controller' => 'value',
                            'template' => '{update} {delete}',
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<i class="fas fa-pencil"></i>', ['value/update', 'id' => $model->id], [
                                        'class' => 'modal-value-open',
                                    ]);
                                },
                            ],
                        ],
                    ],
                    'options' => [
                        'data' => [
                            'sortable' => 1,
                            'sortable-url' => Url::to(['value/sorting']),
                        ]
                    ],
                ]); ?>
                <?php
                $script = <<<JS
                    $('.modal-value-open').on('click', function(e){
                        e.preventDefault();
                        $('#modal-value').modal('show').find('#modal-value-content').load($(this).attr('href'));
                    });
                    JS;
                Yii::$app->view->registerJs($script);
                ?>
                <?php Pjax::end() ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
Modal::begin([
    'id' => 'modal-value',
]);
echo Html::tag('div', '', ['id' => 'modal-value-content']);
Modal::end();
?>