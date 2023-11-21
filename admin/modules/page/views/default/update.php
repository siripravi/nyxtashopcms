<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model dench\page\models\Page */
/* @var $images dench\image\models\Image[] */
/* @var $files dench\image\models\File[] */

$this->title = Yii::t('page', 'Update');
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="page-update">
      <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
        'files' => $files,
    ]) ?>
</div>
