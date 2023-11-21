<?php

use app\admin\models\Payment;
use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Payment Methods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-6">
<div class="card card-primary card-outline product-update">
<div class="card-header ">
<p class="card-title ml-auto p-2">
      <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Payment')), ['create'], ['class' => 'btn btn-flat btn-info']) ?>
</p>
</div>
<div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            [
                'attribute' => 'type',
                'content' => function(Payment $model, $key, $index, $column){
                    $list = Payment::typeList();
                    return @$list[$model->type];
                },
            ],
            [
                'attribute' => 'enabled',
                'content' => function($model, $key, $index, $column){
                    if ($model->enabled) {
                        $class = 'fas fa-ok';
                    } else {
                        $class = '';
                    }
                    return Html::tag('i', '', ['class' => $class]);
                },
            ],
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

</div>
</div>