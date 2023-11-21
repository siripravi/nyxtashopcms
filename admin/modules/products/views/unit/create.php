<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Unit */

$this->title = Yii::t('app', 'Create Unit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Units'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-6">
        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
