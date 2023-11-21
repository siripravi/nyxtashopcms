<?php

namespace admin\modules\sortable\grid;

use admin\modules\sortable\assets\SortableAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\grid\Column;

class SortableColumn extends Column
{
    public $headerOptions = ['style' => 'width: 30px;'];

    public function init()
    {
        SortableAsset::register($this->grid->view);
        $this->grid->view->registerJs('initSortable();', View::POS_READY, 'sortable');
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        return Html::tag('div', '&#9776;', [
            'class' => 'sortable-handler',
            'data-id' => $model->id,
        ]);
    }
}
