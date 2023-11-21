<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-6">
<div class="card card-primary card-outline product-update">
<div class="card-header ">
<p class="card-title ml-auto p-2">
      <?= Html::a(Yii::t('app', 'Create {0}', Yii::t('app', 'Block')), ['create'], ['class' => 'btn btn-flat btn-info']) ?>
</p>
</div>
<div class="card-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'name',
            'controller',
            'enabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>

</div>
</div>