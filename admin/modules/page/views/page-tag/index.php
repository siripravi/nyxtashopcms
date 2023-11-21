<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */


use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\page\models\pageTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('page', 'page Tags');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-tag-index">
    <div class="row">
        <div class="col-6">
            <div class="card card-primary podbor-index">
                <div class="card-header"> 
                    <?= Html::a( Yii::t('page', '<i class="fas fa-plus"></i>&nbsp;&nbsp;Page Tag'), ['create'], ['class' => 'btn btn-block bg-gradient-secondary btn-sm']) ?>
                </div>
                <div class="card-body">   
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\CheckboxColumn'],
                            'id',
                            'name',
                            'frequency',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>