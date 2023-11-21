<?php
namespace app\admin\models;

use Yii;
use rce\material\widgets\Menu as RCEmenu;
use app\modules\cart\models\Order;
use app\admin\models\Question;
use app\admin\models\Review;
use yii\bootstrap5\Nav;

class RMenu  
{
    static function getMenu() {
		if ($unread = Question::unread()) {
        $unread_question = ' <span class="badge badge-danger">' . $unread . '</span>';
    } else {
        $unread_question = '';
    }

    if ($unread = Review::unread()) {
        $unread_review = ' <span class="badge badge-danger">' . $unread . '</span>';
    } else {
        $unread_review = '';
    }

    if ($unread = Order::unread()) {
        $unread_order = ' <span class="badge badge-danger">' . $unread . '</span>';
    } else {
        $unread_order = '';
    }
        $menu = Nav::widget(
            [   //'options' => ['class' => 'nav'],
        'encodeLabels' => false,
                'items' => [
                     ['label' => Yii::t('app', 'Master Data'), 'url' => '#', 'items' => [
               // ['label' => Yii::t('app', 'Upload price'), 'url' => ['/admin/excel/index']],
               // ['label' => Yii::t('app', 'Blocks'), 'url' => ['/admin/block/default/index']],
               // ['label' => Yii::t('app', 'Menu'), 'url' => ['/admin/menu/index']],
                ['label' => Yii::t('app', 'Brands'), 'url' => ['/admin/products/brand/index']],
                ['label' => Yii::t('app', 'Currencies'), 'url' => ['/admin/products/currency/index']],
                ['label' => Yii::t('app', 'Units'), 'url' => ['/admin/products/unit/index']],
                ['label' => Yii::t('app', 'Statuses'), 'url' => ['/admin/products/product-status/index']],
                ['label' => Yii::t('app', 'Users'), 'url' => ['/admin/user/index']],
                ['label' => Yii::t('app', 'Buyers'), 'url' => ['/admin/cart/buyer/index']],
                ['label' => Yii::t('cart', 'Delivery methods'), 'url' => ['/admin/cart/delivery/index']],
                ['label' => Yii::t('cart', 'Payment methods'), 'url' => ['/admin/cart/payment/index']],
               // ['label' => Yii::t('cart', 'LiqPay Log'), 'url' => ['/admin/cart/liqpay-log/index']],
               // ['label' => Yii::t('cart', 'Wfp Log'), 'url' => ['/admin/cart/wfp-log/index']],
            ]],
            ['label' => Yii::t('app', 'Categories'), 'url' => ['/admin/products/category/index']],
            ['label' => Yii::t('app', 'Products'), 'url' => ['/admin/products/default/index']],
            ['label' => Yii::t('app', 'Features'), 'url' => ['/admin/products/feature/index']],
            ['label' => Yii::t('app', 'Complectation'), 'url' => ['/admin/products/complect/index']],
            ['label' => Yii::t('app', 'Blog'), 'url' => '#','items'=>[
			     ['label' => Yii::t('app', 'Posts'), 'url' => ['/admin/page/default/index']],
                ['label' => Yii::t('app', 'Page Category'), 'url' => ['/admin/page/page-category/index']],
                ['label' => Yii::t('cart', 'Comments'), 'url' => ['/admin/page/page-comment/index']],
                ['label' => Yii::t('cart', 'Tags'), 'url' => ['/admin/page/page-tag/index']],
			
			]],
            ['label' => Yii::t('app', 'Orders') . $unread_order, 'url' => ['/admin/cart/order/index']],
            ['label' => Yii::t('app', 'Questions') . $unread_question, 'url' => ['/admin/question/index']],
            ['label' => Yii::t('app', 'Reviews') . $unread_review, 'url' => ['/admin/review/index']],
          //  ['label' => Yii::t('app', 'Selection'), 'url' => ['/admin/podbor/index']],
            
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ]
			]
        );
        return $menu;
    }

}