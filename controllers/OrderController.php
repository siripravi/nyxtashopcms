<?php

namespace app\controllers;

//use common\modules\block\traits\BlockTrait;

use app\modules\cart\models\Order;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use app\components\BaseController;

class OrderController extends BaseController
{
    //use BlockTrait;

    /**
     * @param $id
     * @param $hash
     * @return string
     * @throws ForbiddenHttpException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex($id, $hash)
    {
       // $page = Page::viewPage('order',true);

        if (!$order = Order::findOne($id)) {
            return false;
        }

        if ($hash !== md5($id . Yii::$app->params['order_secret'])) {
            throw new ForbiddenHttpException("403 Forbidden Error");
        }

        return $this->render('index', [
            'order' => $order,
            'items' => $order->orderProducts,
           // 'page' => $page,
        ]);
    }

}
