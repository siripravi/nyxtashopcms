<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-default review-index">
    <div class="card-header">
        <h3>  </h3>
        <div class="card-tools">
        <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Setting')), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
       <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover text-nowrap'],
        'layout' => "{items}\n{pager}",
        //'showHeader' => false,        
        'filterPosition' => 'header',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'value:ntext',
            ['class' => 'yii\grid\ActionColumn','template' => '{update}'],
         ],
        ]); ?>
    </div>
</div>