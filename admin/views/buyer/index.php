<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel dench\cart\models\BuyerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Buyers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buyer-index">
    <div class="card card-warning podbor-index">
        <div class="card-header"> 
            <?= Html::a(Yii::t('app', 'Create Buyer'), ['create'], ['class' => 'btn btn-block bg-gradient-secondary btn-sm']) ?>
        </div>
        <div class="card-body">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    'phone',
                    'email:email',
                    'created_at:date',
                    //'entity',
                    //'delivery',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>    
    </div>
</div>
