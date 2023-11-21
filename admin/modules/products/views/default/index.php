<?php
use admin\modules\products\models\Currency;
use admin\modules\sortable\grid\SortableColumn;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use admin\modules\products\models\Category;
use admin\modules\products\models\Brand;
use admin\modules\products\models\Status;
use yii\bootstrap5\Toast;
use app\admin\components\DemoPager;
use yii\bootstrap5\ButtonToolbar;
use yii\bootstrap5\Button;
use yii\bootstrap5\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel admin\modules\products\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;

if (!Yii::$app->request->get('all') && $dataProvider->totalCount > $dataProvider->count) {
    $showAll = Html::a(Yii::t('app', 'Show all'), Url::current(['all' => 1]));
} else {
    $showAll = '';
}

$currencyDef = Currency::findOne(Yii::$app->params['currency_id']);
?>
<?php
 Toast::begin([
     'title' => 'Hello world!',
     'dateTime' => 'now'
 ]);

 echo 'Say hello...';

 Toast::end();
?>
<?php
  /*echo Breadcrumbs::widget([
      'links' => [
          [
              'label' => 'the item label', // required
              'url' => 'the item URL', // optional, will be processed by `Url::to()`
              'template' => 'own template of the item', // optional
           ],
           ['label' => 'ACTIVE']
      ],
      'options' => [],
  ]); */?>
 
<div class="card h-100 shadow border-0 pl-3">
    <div class="card-header">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">    
            <?= Html::a(Yii::t('app', '<i class="fas fa-plus"></i> Create {0}', Yii::t('app', 'Product')), ['create'], ['class' => 'btn btn-success btn-flat float-right']) ?>
        </div>
    </div>
    <?= ListView::widget([
       // 'tableOptions' => ['class' => 'table table-hover text-nowrap'],
       // 'filterPosition' => 'header',
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'row gx-5'
        ],
       /* 'pager'=>[
         'linkOptions' => ['class'=>'pagination justify-content-center']
        ],*/
        'pager' => [
            'class' => yii\bootstrap5\LinkPager::class,
           // 'options' => ['class'=>'pagination justify-content-center'],
           // 'linkContainerOptions' => ['class' => 'page-item p-2 rounded']
        ],
        'itemOptions' => [
                'class' => 'col'
         ],
      //  'filterModel' => $searchModel,
      /*  'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'data-position' => $model->position,
            ];
        },*/
        'layout' => '<div class="row text-center p-3">{pager}</div><div class="row p-3">{items}</div>{pager}',
        'itemView' => '_product_item',
       /* 'columns' => [
            [
                'class' => SortableColumn::class,
            ],
            [
                'attribute' => 'name',
                'content' => function($model, $key, $index, $column){
                    return Html::a($model->name, ['variant/index', 'VariantSearch[product_id]' => $model->id]);
                },
            ],
            [
                'attribute' => 'category_id',
                'value' => function ($model, $key, $index, $column) {
                    $result = [];
                    foreach ($model->categories as $category) {
                        $result[] = $category->name;
                    }
                    return implode(', ', $result);
                },
                'filter' => Category::getList(null),
                'label' => Yii::t('app', 'Categories'),
            ],
            [
                'attribute' => 'brand_id',
                'value' => 'brand.name',
                'filter' => Brand::getList(null),
            ],
            [
                'attribute' => 'price',
                'value' => function($model){
                    if($model->currency)
                    return $model->currency->before . $model->price . $model->currency->after;
                },
            ],
            [
                'attribute' => 'priceDef',
                'label' => Yii::t('app', 'Price') . ', ' . $currencyDef->before . $currencyDef->after,
            ],
            [
                'attribute' => 'status_id',
                'value' => function ($model, $key, $index, $column) {
                    $result = [];
                    foreach ($model->statuses as $status) {
                        $result[] = $status->name;
                    }
                    return implode(', ', $result);
                },
                'filter' => Status::getList(null),
                'label' => Yii::t('app', 'Status'),
            ],
            [
                'attribute' => 'enabled',
                'filter' => [
                    Yii::t('app', 'Disabled'),
                    Yii::t('app', 'Enabled'),
                ],
                'content' => function($model, $key, $index, $column){
                    if ($model->enabled) {
                        $class = 'fas fa-check';
                    } else {
                        $class = '';
                    }
                    return Html::tag('i', '', ['class' => $class]);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {copy} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="fas fa-eye-open"></span>', ['/product/index', 'slug' => $model->slug], [
                            'target' => '_blank',
                        ]);
                    },
                    'copy' => function ($url, $model, $key) {
                        return Html::a('<span class="fas fa-duplicate"></span>', ['/admin/products/default/create', 'id' => $model->id]);
                    },
                ],
            ],
        ],*/
        'options' => [
            'data' => [
                'sortable' => 1,
                'sortable-url' => Url::to(['sorting']),
            ]
        ],
    ]); ?>


</div>