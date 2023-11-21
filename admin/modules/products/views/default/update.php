<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Product */
/* @var $modelsVariant admin\modules\products\models\Variant[] */
/* @var $variantImages admin\modules\image\models\Image[] */
/* @var $features admin\modules\products\models\Feature[] */
/* @var $files admin\modules\image\models\File[] */

$this->title = Yii::t('app', '{modelClass}: ', [
    'modelClass' => 'Product',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

 <?= $this->render('_form', [
        'model' => $model,
        'modelsVariant' => $modelsVariant,
        'variantImages' => $variantImages,
        'features' => $features,
        'files' => $files,
    ]) ?>
