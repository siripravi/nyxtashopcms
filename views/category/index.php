<?php

/** @var $this yii\web\View */
/** @var $page app\modules\main\components\Page */
/** @var $categories dench\products\models\Category[] */
/** @var $dataProvider yii\data\ActiveDataProvider */

use app\helpers\ImageHelper;
use app\models\Category;
use yii\helpers\Url;
use yii\widgets\ListView;

$this->params['breadcrumbs'][] = "";

?>
<h1 class="mb-3">Categories</h1>

<section class="products-categories">
   <div class="container">
	<div class="row">
    <?php foreach ($categories as $category) : ?>
        <?php
        $url = Url::to((count($category->categories)) ? ['category/pod', 'slug' => $category->slug] : ['category/view', 'slug' => $category->slug]);
        ?>
		<div class="col-md-4">  <!-- new code -->
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
							<?php if ($category->image) { ?>
					<img src="<?= ImageHelper::thumb($category->image->id, 'small') ?>" alt="<?= $category->image->alt ? $category->image->alt : $category->name ?>" title="<?= $category->title ?>" class="card-img rounded-0 img-fluid">
				<?php } else { ?>
					<img class="img-fluid" src="<?= Yii::$app->params['image']['size']['category']['none'] ?>" alt="">
				<?php } ?>
                           
                            </div>
                            <div class="card-body">
                               <a href="<?= $url ?>" class="link">
                   <span class="cat"><i class="uil uil-tag-alt"></i> <?= $category->name ?></span>
                </a>                         
                            </div>
                        </div>
        </div>  <!-- end new code -->
        
    <?php endforeach; ?>

</div>
</div>
</section>