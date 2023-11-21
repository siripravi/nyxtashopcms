<?php
use admin\modules\image\widgets\FilesForm;
use admin\modules\image\helpers\ImageHelper;
use admin\modules\image\widgets\ImagesForm;
use admin\modules\language\models\Language;
use admin\modules\page\helpers\CategoryHelper;
use admin\modules\page\models\Page;
use admin\modules\page\models\PageCategory;
use dosamigos\ckeditor\CKEditor;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model admin\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
/* @var $images admin\modules\image\models\Image[] */
/* @var $files admin\modules\image\models\File[] */

$js = '';

foreach (Language::suffixList() as $suffix => $name) {

$js .= "
var name"  . " = '';
$('#page-name"  . "').focus(function(){
    name"  . " = $(this).val();
}).blur(function(){
    var h1 = $('#page-h1"  . "');
    if (h1.val() == name"  . ") {
        h1.val($(this).val());
    }
    var title = $('#page-title"  . "');
    if (title.val() == name"  . ") {
        title.val($(this).val());
    }
});";

}

$path = ImageHelper::generatePath('fill');

$sizes = [];
foreach (Yii::$app->params['image']['size'] as $key => $size) {
    $sizes[] = "['" . $size['width'] . " x " . $size['height'] . " / " . $size['method'] . "', '" . $key . "']";
}
$size_items = implode(', ', $sizes);

$js .= <<<JS
CKEDITOR.on('dialogDefinition', function(ev) {

    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    
    dialogDefinition.resizable = CKEDITOR.DIALOG_RESIZE_NONE;

    if (dialogName == 'image') {
        dialogDefinition.addContents({
            id: 'Insert',
            label: 'Insert Image',
            elements: [
                {
                    type: 'select',
                    label: 'Size',
                    items: [{$size_items}],
                    labelStyle: 'display: none'
                },
                {
                    type: 'html',
                    html: '<div class="images-data"></div>'
                }
            ]
        });
        var oldOnShow = dialogDefinition.onShow;
        var newOnShow = function () {
            var html = $('<div>').addClass('images-data');
            $('#tab-images').find('img').each(function(){
                var img = $(this);
                var imgId = img.next('input').val();
                var imgAlt = img.next('input').next('.input-group').find('input').val();
                html.append($(this).clone().click(function(){
                    var size = $('div[name="Insert"]').find('select').val();
                    var imgSrc = $(this).attr('src').replace('/fill/', '/' + size + '/');
                    ev.editor.insertHtml('<img src="' + imgSrc + '" alt="' + imgAlt + '" data-id="' + imgId + '">');
                    CKEDITOR.dialog.getCurrent().hide();
                }));
            });
            html.append('<style>.images-data { max-height: 377px; white-space: normal; } .images-data img { border: 1px solid #CCC; padding: 2px; margin: 3px; width: 113px; cursor: pointer; } .images-data img:hover { border: 1px solid #666; }</style>');
            $('.images-data').html(html);
        }
        dialogDefinition.onShow = function() {
            oldOnShow.call(this, arguments);
            newOnShow.call(this, arguments);
        };
    }
});
JS;

$js .= <<<JS
    $('#pageform').submit(function(event){
        if (event.originalEvent) {
            $('[id^="pagetext"]').each(function(){
                var iD;
                var start;
                var end;
                var img;
                var str = $(this).val();
                var str2;
                var dataId;
                var alt;
                var name;
                $(document).find('.file-preview img').each(function(){
                    iD = $(this).next().val();
                    dataId = str.indexOf('data-id="' + iD + '"');
                    if (dataId > 0) {
                        alt = $(this).next().next().find('input').val();
                        name = $(this).next().next().next().find('input').val();
                        
                        img = str.lastIndexOf('<', dataId);
                        
                        start = str.indexOf('alt="', img)+5;
                        end = str.indexOf('"', start);
                        str2 = str.slice(0, start) + alt + str.slice(end);
                        str = str2;
                        
                        start = str.indexOf('src="', img)+5;
                        end = str.indexOf('"', start);
                        start = str.lastIndexOf('/', end)+1;
                        end = str.lastIndexOf('.', end);
                        str2 = str.slice(0, start) + name + str.slice(end);
                        str = str2;
                    }
                });
                eval('CKEDITOR.instances.' + $(this).attr('id') + '.setData(str);');
            });
        }
        return true;
    });
JS;

$this->registerJs($js);
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'id' => 'pageform',
    ]
    ]); ?>
    
        
    <div class="card  border-secondary">
        <div class="card-header d-flex p-1">
            <div class="card-title p-3">Fill the Info</div>
            <ul class="nav nav-tabs  nav-fill ml-auto p-0">
                <li class="nav-item use-max-space">
                    <a href="#tab-main" class="nav-link active" data-bs-toggle="tab"><?= Yii::t('app', 'Main') ?></a>
                </li>
                <li class="nav-item use-max-space">
                    <a href="#tab-images" class="nav-link" data-bs-toggle="tab"><?= Yii::t('app', 'Images') ?></a>
                </li>
                <li class="nav-item use-max-space">
                    <a href="#tab-files" class="nav-link" data-bs-toggle="tab"><?= Yii::t('app', 'Files') ?></a>
                </li>    
            </ul>
            <div class="form-groupd-grid gap-2 col-4 mx-auto pt-3">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-info']) ?>
            </div>
        </div>    
        <div class="card-body"> 
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-main">
                    <!--?= $form->field($model, 'parent_ids')->widget(Select2::classname(), [
                        'data' => CategoryHelper::getTree(true),
                        'options' => [
                            'placeholder' => Yii::t('page', 'Select...'),
                            'multiple' => true,
                            'options' => [
                                $model->id => ['disabled' => true],
                            ]
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        'showToggleAll' => false,
                    ]); ?-->
                    <?= $form->field($model, 'name' )->textInput(['maxlength' => true]) ?>
                    
                    <?= $form->field($model, 'title' )->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'keywords' )->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'tags')->textInput(['maxlength' => 128]) ?>

                    <!--?= $form->field($model, 'slug')->textInput(['maxlength' => 128]) ?-->

                    <!--?= $form->field($model, 'banner')->fileInput() ?-->

                    <?= $form->field($model, 'click')->textInput() ?>
                    <?= $form->field($model, 'description' )->textarea() ?>
                    <?= $form->field($model, 'short' )->widget(CKEditor::className(), [
                        'preset' => 'full',
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                            'height' => 100,
                        ]
                    ]) ?>
                    <?= $form->field($model, 'text' )->widget(CKEditor::className(), [
                        'preset' => 'full',
                        'options' => [
                            'id' => 'pagetext' ,
                        ],
                        'clientOptions' => [
                            'customConfig' => '/js/ckeditor.js',
                            'language' => Yii::$app->language,
                            'allowedContent' => true,
                        ]
                    ]) ?>
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(PageCategory::get(0, PageCategory::find()->all()), 'id', 'str_label')) ?>
                    <?= $form->field($model, 'type')->dropDownList([
                        Page::TYPE_PAGE => Yii::t('page', 'Page'),
                        Page::TYPE_CATEGORY => Yii::t('page', 'Category'),
                    ]) ?>
                    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'enabled')->checkbox() ?>
                    
                    <?= $form->field($model, 'status')->dropDownList(\admin\modules\page\models\Page::getStatusList()) ?>
                    <!--?= $form->field($model, 'status_ids')->checkboxList(Status::getList(null)) ?-->
                
                </div>

                <div class="tab-pane" id="tab-images">
                    <!--?= $form->field($model, 'banner')->fileInput() ?-->
                    <?= ImagesForm::widget([
                        'images' => $images,
                        'image_id' => $model->image_id,
                        'col' => 'col-sm-4 col-md-3',
                        'size' => 'fill',
                        'imageEnabled' => $model->imageEnabled,
                        'fileInputName' => 'images',
                        'label' => null,
                    ]) ?>
                </div>

                <div class="tab-pane fade" id="tab-files">
                    <?= ImagesForm::widget([
                        'images' => $images,
                        'image_id' => $model->image_id,
                        'imageEnabled' => $model->imageEnabled,
                        'col' => 'col-md-4',
                        'size' => 'fill',
                        'label' => null,
                        'modelInputName' => $model->formName(),
                        ]) ?>
                        <!--?= FilesForm::widget([
                            'files' => $files,
                            'fileEnabled' => $model->fileEnabled,
                            'fileName' => $model->fileName,
                            'col' => 'col-sm-4 col-md-3',
                            'label' => null,
                        ]) ?-->
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
