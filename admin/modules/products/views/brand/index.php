<?php

use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-6">
 <div class="card card-primary card-outline product-update">
<div class="card-header ">
<p class="card-title ml-auto p-2 pull-right">
        <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Brand')), ['create'], ['class' => 'btn btn-success']) ?>
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
            'image_id',
            'position',
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

</div>
</div>
