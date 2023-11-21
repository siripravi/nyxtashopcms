<?php

use admin\modules\products\models\Feature;
use admin\modules\products\models\Category;
use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel admin\modules\products\models\FeatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Features');
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}
?>

<div class="row">
    <div class="col-10">
        <div class="card card-secondary feature-index">
            <div class="card-header">              
                <div class="d-grid gap-2 col-4 mx-auto pt-3">
                    <?= Html::a(Yii::t('app', '<i class="fas fa-plus"></i> Create {0}', Yii::t('app', 'Feature')), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
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
                        [
                            'attribute' => 'name',
                            'content' => function($model, $key, $index, $column){
                                return Html::a($model->name, ['value/index', 'ValueSearch[feature_id]' => $model->id]);
                            },
                        ],
                        [
                            'attribute' => 'category_id',
                            'value' => function ($model, $key, $index, $column) {
                                $result = [];
                                foreach ($model->categories as $category) {
                                    $result[] = $category->name;
                                }
                                return implode(', ', $result);
                            },
                            'filter' => Category::getList(null),
                            'label' => Yii::t('app', 'Categories'),
                        ],
                        'after:html',
                        'enabled',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete} {view}',
                            'buttons'  => [
                                'view' => function ($url, $model) {
                                    return Html::a(
                                        '<i class="bi bi-stack"></i>',
                                        Url::to(['value/index', 'ValueSearch[feature_id]' => $model->id]),
                                        [
                                            'rel'                      => "tooltip",
                                            'data-original-title'      => 'View values',
                                            'data-placement'           => 'top',
                                            'style'                    => 'margin-right: 10px'
                                        ]
                                    );
                                },
                            ]
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
