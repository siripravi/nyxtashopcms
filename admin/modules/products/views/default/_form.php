<?php
use admin\modules\language\models\Language;

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

use yii\bootstrap5\Tabs;

/* @var $this yii\web\View */
/* @var $model admin\modules\products\models\Product */
/* @var $modelsVariant admin\modules\products\models\Variant[] */
/* @var $variantImages admin\modules\image\models\Image[] */
/* @var $form yii\bootstrap5\ActiveForm */

$js = '';

foreach (Language::suffixList() as $suffix => $name) {

    $js .= "
var name" . $suffix . " = '';
$('#product-name" . $suffix . "').focus(function(){
    name" . $suffix . " = $(this).val();
}).blur(function(){
    var h1 = $('#product-h1" . $suffix . "');
    if (h1.val() == name" . $suffix . ") {
        h1.val($(this).val());
    }
    var title = $('#product-title" . $suffix . "');
    if (title.val() == name" . $suffix . ") {
        title.val($(this).val());
    }
});";

}

$var = "Variant";

$js .= "
$('.variantsWrapper').on('afterInsert', function(e, item) {
    reloadPjaxImages();
    reloadPjaxFeature();
});
$('.variantsWrapper').on('afterDelete', function(e, item) {
    reloadPjaxImages();
    reloadPjaxFeature();
});
$('.variantsWrapper').on('beforeDelete', function(e, item) {
    var key = item.firstElementChild.id.split('-')[1];
    $('.variants-images').find('input[name^=\"" . $var . "['+key+'][image_id]\"]').parents('.variant-images').remove();
    $('.variants-images').find('input[name^=\"" . $var . "\"]').each(function(){
        var name_old = $(this).attr('name');
        var k = parseInt(name_old.replace('" . $var . "[', '').split(']')[0]);
        if (k > key) {
            var name_new = name_old.replace('" . $var . "['+k+']', '" . $var . "['+(k-1)+']');
            $(this).attr('name', name_new);
        }
    });
});
function reloadPjaxImages() {
    $.pjax.reload({
        container: '#images-pjax', 
        timeout: 2000,
        url: '',
        type: 'POST',
        data: $('#product-form').serialize(),
        async: false,
    });
}
function reloadPjaxFeature() {
    $.pjax.reload({
        container: '#feature-pjax', 
        timeout: 2000,
        url: '',
        type: 'POST',
        data: $('#product-form').serialize(),
        async: false,
    });
}
$('#product-category_ids').change(function(){
    reloadPjaxFeature();
});
";

$this->registerJs($js);
?>

<div id="w33"></div>
<div id="w34"></div>
<div id="w35"></div>
<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
    'validateOnChange' => true,
    'validateOnBlur' => false,
    'layout' => 'horizontal',
    'options' => [
        'enctype' => 'multipart/form-data',
        'id' => 'product-form',
    ]
]); ?>
<?php
$lsList = Language::suffixList();
// echo '<pre>';
//print_r($lsList); die;
foreach ($lsList as $suffix => $name) {
    $items[] = [
        'label' => $name,
        'content' => $this->render("_tab" . $suffix, ['model' => $model, 'suffix' => $suffix, 'form' => $form]),
        'active' => empty($suffix)
    ];
}
$items[] = [
    'label' => 'Main',
    'content' => $this->render("_tab_main", ['model' => $model, 'form' => $form]),

];
$items[] = [
    'label' => 'Variants',
    'content' => $this->render("_tab_variants", ['model' => $model, 'form' => $form, 'lsList' => $lsList, 'modelsVariant' => $modelsVariant]),
    //'headerOptions'=>['class'=>'col-4']
];
$items[] = [
    'label' => '<i class="bi bi-file-earmark-text"></i><span>Files</span>',
    
    'content' => $this->render("_tab_files", ['model' => $model, 'form' => $form, 'files' => $files]),

];
$items[] = [
    'label' => '<i class="bi bi-image-alt me-2"></i><span>Images</span>',
    'content' => $this->render("_tab_v_images", ['model' => $model, 'form' => $form, 'variantImages' => $variantImages]),

];
$items[] = [
    'label' => 'Features',
    'content' => $this->render("_tab_features", [
        //'model'=>$model,
        //'form'=>$form,
        'modelsVariant' => $modelsVariant,
        'features' => $features
    ]),

];
$items[] = [
    'label' => 'Group',
    'content' => $this->render("_tab_comp", [
        'model' => $model,
        'form' => $form,
        //'autoIdPrefix' => $autoIdPrefix,


    ]),

];
$items[] = [
    'label' => 'Options',
    'content' => $this->render("_tab_options", ['model' => $model, 'form' => $form]),

];
?>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="row p-2">
                <div class="col-8 justify-content-start">
                    <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i> Please fill
                        all the
                        required information ad click the button on right.</div>
                </div>
                <div class="col-4 justify-content-end">
                    <?= Html::submitButton($model->isNewRecord ? "<i class='fas fa-save'></i>&nbsp;" . Yii::t('app', 'Create') : "<i class='fas fa-save'></i>&nbsp;" . Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-md btn-warning' : 'btn btn-warning']) ?>
                </div>
            </div>

            <div class="card-body">
                <?php
                echo Tabs::widget([
                    // 'navType' => 'nav-tabs card-header full-width-tabs',
                    'navType' => 'nav nav-tabs',
                    'items' => $items,
                    'encodeLabels' => false,
                    'tabContentOptions' => ['class' => 'pt-6'],
                    'itemOptions' => ['class' => 'p-4'],
                    //   'headerOptions' => ['class' => 'use-max-space']
                
                ]);
                ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>