<?php

use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel admin\modules\page\models\Page */
/* @var $dataProvider yii\data\ActiveDataProvider */

$parent_id = null;

if (isset($dataProvider->models[0]->parent)) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
    if (isset($dataProvider->models[0]->parent->parent)) {
        $this->params['breadcrumbs'][] = ['label' => $dataProvider->models[0]->parent->parent->title, 'url' => ['index', 'PageSearch[parent_id]' => $dataProvider->models[0]->parent->parent->id]];
    }
    $this->title = $dataProvider->models[0]->parent->title;
    $parent_id = $dataProvider->models[0]->parent->id;
} else {
    $this->title = Yii::t('page', 'Pages');
}
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}
?>
<section class="page-default-index">
    <h1>
        <?= Yii::t('page', 'Welcome to page Module'); ?>
    </h1>
</section>
<div class="page-index">
    <div class="card card-primary podbor-index">
        <div class="card-header"> 
            <?= Html::a(Yii::t('page', 'Create Page'), ['create', 'parent_id' => $parent_id], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="card-body">           
            <?= GridView::widget([
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
                        'class' => SortableColumn::className(),
                    ],
                    [
                        'attribute' => 'title',
                        'content' => function($data) {
                            if ($data->type) {
                                return Html::a('<i class="fas fa-folder-open"></i> ' . $data->title, ['index', 'PageSearch[parent_id]' => $data->id]);
                            } else {
                                return $data->title;
                            }
                        }
                    ],
                    'slug',
                    'created_at:date',
                    [
                        'attribute' => 'enabled',
                        'filter' => [
                            Yii::t('app', 'Disabled'),
                            Yii::t('app', 'Enabled'),
                        ],
                        'content' => function($model, $key, $index, $column){
                            if ($model->enabled) {
                                $class = 'fas fa-check';
                            } else {
                                $class = '';
                            }
                            return Html::tag('i', '', ['class' => $class]);
                        },
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
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
