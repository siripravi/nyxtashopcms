<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Brand */

$this->title = Yii::t('app', 'Create Brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
   </div>
</div>
