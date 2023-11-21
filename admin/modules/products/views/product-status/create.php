<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Status */

$this->title = Yii::t('app', 'Create Product Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
 
