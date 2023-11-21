<?php

use admin\modules\products\models\Feature;
use admin\modules\sortable\grid\SortableColumn;
use yii\bootstrap5\Modal;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $feature_id integer */

$this->title = Yii::t('app', 'Values');
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}
?>
<div class="card card-primary">
    <div class="row p-2">
        <div class="col-8 justify-content-start">
            <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Add possible values for the feature</div>
        </div>
        <div class="col-4 justify-content-end">
            <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Value')), ['create', 'feature_id' => $feature_id], ['class' => 'btn btn-success buttonCreate']) ?>
        </div>
    </div>
    <div class="card-body">
        <?php Pjax::begin([
            'id' => 'pjax-grid-values',
        ]) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,

            'rowOptions' => function ($model, $key, $index, $grid) {
                return [
                    'data-position' => $model->position,
                ];
            },
            'layout' => "{summary}\n{$showAll}\n{items}\n{pager}",
            'columns' => [
                [
                    'class' => SortableColumn::class,
                ],
                [
                    'attribute' => 'feature_id',
                    'filter' => Feature::getList(null, null),
                    'value' => 'feature.name',
                ],
                'name',
                [
                    'attribute' => 'after',
                    'format' => 'html',
                    //  'filter' => Feature::getList(null, null),
                    /*  'value' => function ($model) {
                          return Html::decode($model->feature->after);
                        }*/
                    'value' => 'feature.after'
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="bi bi-pencil"></i>', ['update', 'id' => $model->id], [
                                'class' => 'modal-value-open',
                                'title' => Yii::t('app', 'Update'),
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="fas fa-trash"></span>',
                                $url,
                                [
                                    'class' => 'ajax-value-delete',
                                    'title' => Yii::t('app', 'Delete'),
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                        'ajax' => 1,
                                    ],
                                ]
                            );
                        }
                    ],
                ],
            ],
            'options' => [
                'data' => [
                    'sortable' => 1,
                    'sortable-url' => Url::to(['sorting']),
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
<?php
Modal::begin([
    'id' => 'modal-value',
]);
echo Html::tag('div', '', ['id' => 'modal-value-content']);
Modal::end();

$script = <<<JS
$('.buttonCreate').on('click', function(e){
    e.preventDefault();
    $('#modal-value').modal('show').find('#modal-value-content').load($(this).attr('href'));
});
JS;
Yii::$app->view->registerJs($script);
?>