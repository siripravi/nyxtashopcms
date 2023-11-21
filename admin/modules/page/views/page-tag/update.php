<?php
/**
 * Project: yii2-blog for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\blog\Module;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\PageTag */

$this->title = Yii::t('page', 'Update ') . Yii::t('page', 'Blog Tag') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'Blog Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('page', 'Update');
?>
<div class="blog-tag-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
