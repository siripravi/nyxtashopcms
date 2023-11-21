<?php

use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary">
    <div class="card-header ">
        <p class="card-title ml-auto p-2">
            <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Currency')), ['create'], ['class' => 'btn btn-flat btn-info']) ?>
        </p>
    </div>
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-hover text-nowrap'],
            'filterPosition' => 'header',
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
                'after',
                'before',
                'code',
                'rate',
                'enabled',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                ],
            ],
            'options' => [
                'data' => [
                    'sortable' => 1,
                    'sortable-url' => Url::to(['sorting']),
                ]
            ],
        ]); ?>
    </div>
</div>