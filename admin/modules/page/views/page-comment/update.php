<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;

/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\pageComment */

$this->title = Yii::t('page', 'Update ') . Yii::t('page', 'page Comment') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'page Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('page', 'Update');
?>
<div class="page-comment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
