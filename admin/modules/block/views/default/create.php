<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model dench\block\models\Block */

$this->title = Yii::t('app', 'Create Block');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="block-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
