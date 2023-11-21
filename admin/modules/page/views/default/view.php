<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model dench\page\models\Page */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary page-view">
    <p>
        <?= Html::a(Yii::t('page', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('page', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('page', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'slug',
            'created_at',
            'updated_at',
            'enabled',
        ],
    ]) ?-->
       <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->title,
            ],
            'title',
            'brief:ntext',
            'content:html',
            'tags',
            'slug',
            [
                'attribute' => 'banner',
                'value' => $model->getThumbFileUrl('banner', 'thumb'),
            ],
            'click',
           /* [
                'attribute' => 'user',
                'value' => ($model->user) ? $model->user->{Yii::getInstance()->userName} : 'Отсутствует',
            ],*/
            [
                'attribute' => 'status',
                'value' => $model->getStatus(),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
