<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\models\PageCategory;
use admin\modules\page\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel admin\modules\page\models\pageCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page', 'page Categorys');
$this->params['breadcrumbs'][] = $this->title;
$parent_id = null;
/*
if (isset($dataProvider->models[0]->parent)) {
    $this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
    if (isset($dataProvider->models[0]->parent->parent)) {
        $this->params['breadcrumbs'][] = ['label' => $dataProvider->models[0]->parent->parent->name, 'url' => ['index', 'PageSearch[parent_id]' => $dataProvider->models[0]->parent->parent->id]];
    }
    $this->title = $dataProvider->models[0]->parent->name;
    $parent_id = $dataProvider->models[0]->parent->id;
} else {
    $this->title = Yii::t('page', 'Pages');
}*/
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}
?>

<div class="page-category-index">    
        <div class="card card-primary podbor-index">
            <div class="card-header"> 
                <?= Html::a(Yii::t('page', 'Create ') . Yii::t('page', '<i class="fas fa-plus"></i>&nbsp;&nbsp;Page Category'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="card-body">           
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 
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
                        /* 'content' => function($data) {
                                if ($data->type) {
                                    return Html::a('<i class="fas fa-folder-open"></i> ' . $data->title, ['index', 'PageSearch[parent_id]' => $data->id]);
                                } else {
                                    return $data->title;
                                }
                            }*/
                        ],
                        'slug',
                        'created_at:date',
                        
                        [
                            'attribute' => 'status',
                        /* 'filter' => [
                                Yii::t('app', 'Disabled'),
                                Yii::t('app', 'Enabled'),
                            ],*/
                        /*  'content' => function($model, $key, $index, $column){
                                if ($model->enabled) {
                                    $class = 'fas fa-ok';
                                } else {
                                    $class = '';
                                }
                                return Html::tag('i', '', ['class' => $class]);
                            },*/
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
