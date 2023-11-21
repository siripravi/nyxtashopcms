<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;

/* @var $this yii\web\View */
/* @var $model admin\modules\page\models\pageCategory */

$this->title = Yii::t('page', 'Create ') . Yii::t('page', 'page Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'page Categorys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
