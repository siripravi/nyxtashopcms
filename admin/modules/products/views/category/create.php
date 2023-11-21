<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Category */
/* @var $images admin\modules\image\models\Image[] */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
    ]) ?>

</div>