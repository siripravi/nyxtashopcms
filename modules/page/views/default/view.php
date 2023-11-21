<?php
/**
 * Project: yii2-blog for internal using
 * Author: common\modules
 * Copyright (c) 2018.
 */
/* @var $this \yii\web\View */
/* @var $post \common\modules\blog\models\BlogPost */

/* @var $dataProvider \yii\data\ActiveDataProvider */

use app\modules\page\Module;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
app\assets\SiteAsset::register($this);

$this->title = $post->title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $post->short
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => $this->title
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => $post->short,
        'image' => $post->getImageFileUrl('banner'),
    ]);
}

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('page', 'Blog'),
    'url' => ['default/index']
];
$this->params['breadcrumbs'][] = $this->title;
$post_user = $post->user;
$username_attribute = Module::getInstance()->userName;
?>
<?php
$this->title = $post->title;
Yii::$app->view->registerMetaTag([
    'name' => 'description',
    'content' => $post->short
]);
Yii::$app->view->registerMetaTag([
    'name' => 'keywords',
    'content' => $this->title
]);

if (Yii::$app->get('opengraph', false)) {
    Yii::$app->opengraph->set([
        'title' => $this->title,
        'description' => $post->short,
        'image' => $post->getImageFileUrl('banner'),
    ]);
}

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('page', 'Blog'),
    'url' => ['default/index']
];
$this->params['breadcrumbs'][] = $this->title;
$post_user = $post->user;
$username_attribute = Module::getInstance()->userName;
?>
<section class="py-5">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-3">
                <div class="d-flex align-items-center mt-lg-5 mb-4">
                    <img class="img-fluid rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="...">
                        <div class="ms-3">
                            <div class="fw-bold">Valerie Luna</div>
								<?php if ($post->tagLinks): ?>
                                    <div class="text-muted" title="<?= Yii::t('page', 'Tags'); ?>">
                                        <i class="fa fa-tag"></i> <?= implode(' ', $post->tagLinks); ?>
                                    </div>					
                                <?php endif; ?>                        
                            </div>                            
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
					    		<h1 class="fw-bolder mb-1"><?= Html::encode($post->title); ?></h1>
                                <!-- Post meta content-->
								<time title="<?= Yii::t('page', 'Create Time'); ?>" itemprop="datePublished"
                                    datetime="<?= date_format(date_timestamp_set(new DateTime(), $post->created_at), 'c') ?>">
                                    <i class="fa fa-calendar-alt"></i> <?= Yii::$app->formatter->asDate($post->created_at); ?>
                                </time>
                                <div class="text-muted fst-italic mb-4">
								    <span title="<?= Yii::t('page', 'Click'); ?>">
                                        <i class="fa fa-eye"></i> <?= $post->click; ?>&nbsp;views
                                    </span>
								 </div>  
                                    <!-- Post categories-->
                                <?= Html::a($post->category->title, ['default/index', 'category_id' => $post->category->id, 'slug' => $post->category->slug], ['class' => 'badge bg-secondary text-decoration-none link-light']); ?>
                            </header>
                            <!-- Preview image figure-->
							<?php if ($post->banner) : ?>
                                <div itemscope itemprop="image" itemtype="http://schema.org/ImageObject" class="blog-post__img">
                                    <figure class="mb-4"><img itemprop="url contentUrl" src="<?= $post->getThumbFileUrl('banner', 'thumb'); ?>" alt="<?= $post->title; ?>" class="img-fluid rounded">
                                    <meta itemprop="url" content="<?= $post->getThumbFileUrl('banner', 'thumb'); ?>">
                                    </figure>
                                    <meta itemprop="width" content="400">
                                    <meta itemprop="height" content="300">
                                </div>
                            <?php endif; ?>
                            <!-- Post content-->
                            <section class="mb-5">                                
                                <?php echo \yii\helpers\HtmlPurifier::process($post->text, [
                                    'HTML.AllowedElements' => 'iframe,p,strong,b,i,br,ul,ol,li,img',
                                    "HTML.SafeIframe" => true,
                                    "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/|api.soundcloud.com/tracks/|www.youtube-nocookie.com/embed/)%",
                                ]); ?>
                            </section>
                        </article>
                        <!-- Comments section-->
                        <div class="card bg-light">
                            <div class="card-body"> </div>                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>
<?php if (\Yii::$app->getModule('blog')->enableComments) : ?>   
    <section id="comments" class="blog-comments">
        <h2 class="blog-comments__header title title--2"><?= Yii::t('page', 'Comments'); ?></h2>
        <div class="row">
            <div class="col-md-6">
                <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_comment',
                        'viewParams' => [
                            'post' => $post
                        ],
                ]) ?>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <h3><?= Yii::t('page', 'Write comments'); ?></h3>
                <?= $this->render('_form', [
                        'model' => $comment,
                ]); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<article class="xblog-post" itemscope itemtype="http://schema.org/Article">
    <meta itemprop="author" content="<?= $post_user ? $post_user->{$username_attribute} : ''; ?>">
    <meta itemprop="dateModified" content="<?= date_format(date_timestamp_set(new DateTime(), $post->updated_at), 'c') ?>"/>
    <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?= $post->getAbsoluteUrl(); ?>"/>
    <meta itemprop="commentCount" content="<?= $dataProvider->getTotalCount(); ?>">
    <meta itemprop="genre" content="<?= $post->category->title; ?>">
    <meta itemprop="articleSection" content="<?= $post->category->title; ?>">
    <meta itemprop="inLanguage" content="<?= Yii::$app->language; ?>">
    <meta itemprop="discussionUrl" content="<?= $post->getAbsoluteUrl(); ?>">
    <?php if (isset($post->module->schemaOrg) && isset($post->module->schemaOrg['publisher'])) : ?>
        <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="blog-post__publisher">
            <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <meta itemprop="url image" content="<?= Yii::$app->urlManager->createAbsoluteUrl($post->module->schemaOrg['publisher']['logo']); ?>"/>
                <meta itemprop="width" content="<?= $post->module->schemaOrg['publisher']['logoWidth']; ?>">
                <meta itemprop="height" content="<?= $post->module->schemaOrg['publisher']['logoHeight']; ?>">
            </div>
            <meta itemprop="name" content="<?= $post->module->schemaOrg['publisher']['name'] ?>">
            <meta itemprop="telephone" content="<?= $post->module->schemaOrg['publisher']['phone']; ?>">
            <meta itemprop="address" content="<?= $post->module->schemaOrg['publisher']['address']; ?>">
        </div>
    <?php endif; ?>
</article>