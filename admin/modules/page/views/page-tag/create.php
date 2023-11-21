<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;


/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\pageTag */

$this->title = Yii::t('page', 'Create ') . Yii::t('page', 'page Tag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'page Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-tag-create">
    <div class="row">
        <div class="col-6">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
