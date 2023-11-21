<?php
/**
 * Project: yii2-page for internal using
 * Author: admin\modules
 * Copyright (c) 2018.
 */

use admin\modules\page\Module;


/* @var $this yii\web\View */
/* @var $model backend\modules\page\models\pageComment */

$this->title = Yii::t('page', 'Create ') . Yii::t('page', 'page Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('page', 'page Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-comment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
