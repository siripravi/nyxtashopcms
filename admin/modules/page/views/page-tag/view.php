<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\pageTag */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'page Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-tag-view">
    <div class="row">
        <div class="col-6">
            <div class="card card-primary">
            <div class="card-actions">
                <?= Html::a(Yii::t('page', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('page', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger text-right',
                    'data' => [
                        'confirm' => Yii::t('page', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'frequency',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
