<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 13:30
 *
 * @var $model dench\products\models\Product
 * @var $link string
 * @var $rating array
 */

use app\widgets\PriceTable;
use app\helpers\ImageHelper;

$variant = @$model->variants[0];

if (@$model->variants[0]->price) {
    $available = 0;
    foreach ($model->variants as $variant) {
        if ($variant->enabled) {
            if ($variant->available < 0) {
                $available = -1;
            }
            if ($variant->available > 0) {
                $available = 1;
                break;
            }
        }
    }
}
?>
    <div class="col-12 bg-white text-center h-100 product-item">
        <div class="row h-100">
            <?php if ($model->image) { ?>
                <div class="col-12 p-0 mb-3">
                    <a href="<?= $link; ?>">
                        <img src="<?= ImageHelper::thumb($model->image->id, 'micro') ?>"
                            alt="<?= $model->image->alt ? $model->image->alt : $model->name ?>" title="<?= $model->title ?>"
                            class="img-fluid">
                    </a>


                <?php } else { ?>
                    <img class="card-img-top" src="<?= Yii::$app->params['image']['none'] ?>" alt="">
                <?php } ?>
            </div>
            <div class="col-12 mb-3">
                <a href="<?= $link; ?>" class="product-name">
                    <?= $model->categories[0]->shortTitle; ?>
                </a>
            </div>

            <!--<span class="badge bg-success position-absolute text-white mt-2 ms-2"><a href="/" class="text-white">
                    <= $model->categories[0]->shortTitle; ?>
                </a></span>
            <php if ($model->statuses): ?>
                <span class="badge  text-white position-absolute r-0 mt-2 me-2"
                    style="background-color:<= $model->statuses[0]->color; ?>;">
                    <= $model->statuses[0]->name; ?>
                </span>
            <php endif; ?>
           -->
            <div class="col-12 mb-3">
                <span class="product-price-old">
                    <?php echo $model->variants[0]->price; ?>
                </span>
                <br>
                <span class="product-price">
                    <?php echo $model->variants[0]->price_old; ?>
                </span>
            </div>
            <div class="card-body overflow-hidden position-relative p-0">
                <h6 class="card-subtitle mb-2"><a class="text-decoration-none" href="<?= $link; ?>">
                        <?= $model->name; ?>
                    </a></h6>
                <div class="my-2"><span class="fw-bold h5">
                        <?php echo $model->variants[0]->price; ?>
                    </span>
                    <!--<del class="small text-muted ms-2">$2000</del>  -->
                    <span class="ms-2">
                        <?php
                        /* $floor = floor($rating['value']);
                         for ($i = 0; $i < $floor; $i++) {
                             echo '<span><i class="fa fa-star text-warning"></i></span> ';
                             }
                         if ($floor < $rating['value']) {
                                 echo '<span><i class="fa fa-star-half text-warning"></i></span> ';
                         }*/
                        ?>
                    </span>
                </div>
                <div class="col-12 mb-3 align-self-end">
                    <button class="btn btn-outline-dark" type="button"><i class="fas fa-cart-plus me-2"></i>Add to
                        cart</button>
                </div>
            </div>
        </div>
    </div>
