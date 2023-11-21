<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 02.04.17
 * Time: 22:52
 *
 * @var $model dench\products\models\Product
 */

use app\widgets\Gallery;
use app\helpers\ImageHelper;
use app\widgets\Carousel;
use yii\helpers\Html;
?>
<?php
$images = [];
foreach ($model->variants as $variant) {
    foreach ($variant->images as $image) {
        $images[] = $image;
    }
}
$items = [];
foreach ($images as $photo) {
    $items[] = [
        'image' => ImageHelper::thumb($photo->id, 'big'),
        'thumb' => ImageHelper::thumb($photo->id, 'micro'),
        'width' => Yii::$app->params['image']['size']['big']['width'],
        'height' => Yii::$app->params['image']['size']['big']['height'],
        'title' => $photo->alt,
    ];
}
$thumbnails[0] = ($model->image) ? ['thumb' => ImageHelper::thumb($model->image->id, 'big')] : [];
$galleryItems = [];
if($images){
foreach ( $images as $id => $photo) {
	$thumbnails[$id] = ['thumb' => ImageHelper::thumb($photo->id, 'micro')];
    $galleryItems[] = [
        'content' => Html::img(ImageHelper::thumb($photo->id, 'big')),
        'options' => [		   
            'title' => $photo->alt,
        ],
    ];
}
}
?>
<div class="col-lg-6 mt-5">
<?php	echo Carousel::widget([
      'items' => 
          $galleryItems,
       'thumbnails'  => $thumbnails,
       'options' => [       
            'data-interval' => 3, 'data-bs-ride' => 'scroll','class' => 'carousel product_img_slide',
        ],
	   //'options'  => ['class' => 'carousel product_img_slide','ride'=>true]
      
  ]); ?>
  </div>