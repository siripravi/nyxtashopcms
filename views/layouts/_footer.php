<?php
use yii\bootstrap5\Nav;
use yii\helpers\Url;
use yii\widgets\Menu;
use kartik\icons\Icon;
?>
<footer class="row bg-gradient-dark">
    <div class="container-fluid bg-primary">
        <div class="row ">
            <div class="col-md-9 py-3 text-white">Get connected with us on social networks!</div>
            <div class="col-md-3 py-3 text-center text-white">
                <div class="d-inline-flex">
                    <a href="#" class="px-2" title="Follow on Facebook"><img src="/image/site/facebook.svg"></a>
                    <a href="#" class="px-2"><img src="/image/site/twitter.svg"></a>
                    <a href="#" class="px-2"><img src="/image/site/instagram.svg"></a>
                    <a href="#" class="px-2"><img src="/image/site/linkedin.svg"></a>
                    <a href="#" class="px-2"><img src="/image/site/youtube.svg"></a>
                    <a href="#" class="px-2"><img src="/image/site/pinterest.svg"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white">
        <div class="row px-xl-5 pt-5 ">
            <div class="col-lg-4 col-md-12 text-white mb-5">
                <div class="mb-3">
                    <h1><span class=" border rounded-2 border-warning px-3 me-2">N</span>yxta</h1>
                </div>
                <p>Home made craft store</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-warning me-3"></i>hyderabad, INDIA</p>
                <p class="mb-2"><i class="fa fa-envelope text-warning me-3"></i>support@nyxta.in</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-warning me-3"></i>(+91) 83318 52700</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row justify-content-evenly">
                    <div class="col-md-4 mb-5">
                        <h5 class="fw-bold text-white mb-4">Quick Links</h5>
                        <div class="">
                            <?php
                            $items = [
                                ['label' => Yii::t('app', 'Home'), 'url' => ['/'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'Catalog'), 'url' => ['/category/index'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'Find product'), 'url' => ['/podbor/index'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'How to order'), 'url' => ['/site/how'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => 'FAQ', 'url' => ['/site/questions'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'Information'), 'url' => ['/info/index'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'Contacts'), 'url' => ['/site/contacts'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                                ['label' => Yii::t('app', 'Reviews'), 'url' => ['/site/reviews'], 'options' => ['class' => 'list-group-item bg-dark text-white border-light']],
                            ];
                            echo Menu::widget([
                                'items' => $items,
                                'encodeLabels' => false,
                                'linkTemplate' => '<a class="text-decoration-none text-white stretched-link" href="{url}"><i class="fa fa-arrow-right me-3"></i>{label}</a>',
                                'options' => ['class' => 'list-group list-group-flush', 'style' => 'list-style:none;'],
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="fw-bold text-white mb-4">Newsletter</h5>
                        <form>
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-3 mb-2" placeholder="Your Name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-3 mb-3" placeholder="Your Email"
                                    required>
                            </div>
                            <div>
                                <a href="#" type="button" id="btn" style="--clr:#ffc107"><span>Subscribe
                                        Now</span><i></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary text-white text-center">
        <div class="row">
            <div class="text-center py-2 bg-gradient-secondary text-white">
                2019 -
                <?= date('Y') ?> © <a href="<?= Url::to(['/']) ?>">
                    <?= Yii::$app->name ?>
                </a>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <?= Icon::show("arrow-up");?>
    </button>
</footer>