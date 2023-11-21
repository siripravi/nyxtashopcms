<?php

namespace admin\modules\sortable\actions;

use Exception;
use Yii;
use yii\base\Action;
use yii\db\ActiveQuery;
use yii\web\BadRequestHttpException;

class SortingAction extends Action
{
    /** @var ActiveQuery */
    public $query;

    /** @var string */
    public $orderAttribute = 'position';

    public function run()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $ids = Yii::$app->request->post('ids');
            $position = Yii::$app->request->post('position');
            foreach ($ids as $key => $id) {
                $query = clone $this->query;
                $model = $query->andWhere(['id' => $id])->one();
                if ($model === null || $position[$key] === null) {
                    throw new BadRequestHttpException();
                }
                $model->{$this->orderAttribute} = $position[$key];
                $model->update(false, [$this->orderAttribute]);
            }
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }
    }
}
