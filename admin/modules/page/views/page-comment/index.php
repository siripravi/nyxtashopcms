<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\models\Status;
use admin\modules\page\Module;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel \admin\modules\page\models\pageCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page', 'page Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-comment-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('page', 'Create ') . Yii::t('page', 'page Comment'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Html::beginForm(['bulk'], 'post'); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

            [
                'attribute' => 'post_id',
                'value' => function ($model) {
                    return mb_substr($model->post->title, 0, 15, 'utf-8') . '...';
                },
                /*'filter' => Html::activeDropDownList(
                    $searchModel,
                    'post_id',
                    \admin\modules\page\models\pagePost::getArrayCategory(),
                    ['class' => 'form-control', 'prompt' => Module::t('page', 'Please Filter')]
                )*/
            ],
            [
                'attribute' => 'content',
                'value' => function ($model) {
                    return mb_substr(Yii::$app->formatter->asText($model->content), 0, 30, 'utf-8') . '...';
                },
            ],
            'author',
            'email:email',
            // 'url:url',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->status === \admin\modules\page\traits\IActiveStatus::STATUS_ACTIVE) {
                        $class = 'label-success';
                    } elseif ($model->status === \admin\modules\page\traits\IActiveStatus::STATUS_INACTIVE) {
                        $class = 'label-warning';
                    } else {
                        $class = 'label-danger';
                    }

                    return '<span class="label ' . $class . '">' . $model->getStatus() . '</span>';
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    \admin\modules\page\models\Page::getStatusList(),
                    ['class' => 'form-control', 'prompt' => Yii::t('page', 'PROMPT_STATUS')]
                )
            ],

            'created_at:date',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?= Html::dropDownList('action', '',
                [
                    '' => 'Choose',
                    'c' => Yii::t('page', 'Confirm'),
                    'd' => Yii::t('page', 'Delete')
                ], ['class' => 'form-control dropdown',]) ?>
        </div>
        <div class="col-md-4">
            <?= Html::submitButton(Yii::t('page', 'Send'), ['class' => 'btn btn-info',]); ?>
        </div>
    </div>

    <?= Html::endForm(); ?>
</div>
