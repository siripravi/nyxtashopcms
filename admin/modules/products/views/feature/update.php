<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Feature */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Feature',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Features'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
  <?= $this->render('_form', [
        'model' => $model,
        'values' => $values,
    ]) ?>
