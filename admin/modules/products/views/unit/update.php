<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Unit */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Unit',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
  <div class="col-6">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
</div>
