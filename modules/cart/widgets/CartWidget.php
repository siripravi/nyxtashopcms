<?php

/**
 * Created by PhpStorm.
 * User: siripravi
 * Date: 20.11.23
 * Time: 14:02
 */

namespace app\modules\cart\widgets;

use app\modules\cart\models\Cart;
use app\models\Variant;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class CartWidget extends Widget
{
    public $id = 'bag';

    public $options = [];

    public $urlCart = ['/bag/index'];

    public function run()
    {
        $cart = Cart::getCart();
        $variant_ids = array_keys($cart);
        $items = Variant::find()->where(['id' => $variant_ids])->andWhere(['enabled' => true])->all();
        
        return $this->render("ocart",['cartUrl' => $this->urlCart,'items'=> $items, 'cart' => $cart]);
    }

    private function registerClientScript()
    {
        $url = Url::to(['/bag/block']);

        $js = <<< JS
function reloadCart() {
    $.get('{$url}', function(data) {
        $('#{$this->id}').after(data).remove();
    });
}
JS;
  //  $this->view->registerJs($js);
    }
}
