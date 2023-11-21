<?php

use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel admin\modules\products\models\ComplectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Group');
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}
?>
<div class="row">
    <div class="col-6">
<div class="card card-secondary feature-index">
        <div class="card-header">              
            <div class="row justify-content-end">
                <?= Html::a(Yii::t('app', '<i class="fas fa-plus"></i> Create {0}', Yii::t('app', 'Group')), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="card-body table-responsive p-3">    
            <?= GridView::widget([
                'tableOptions' => ['class' => 'table table-hover text-nowrap'],
                'filterPosition' => 'header',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                    'name',

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