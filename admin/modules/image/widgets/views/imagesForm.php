<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 20:44
 *
 * @var $images dench\image\models\Image[]
 * @var string $size
 * @var string $modelInputName
 * @var string $fileInputName
 * @var string $label
 * @var integer $image_id
 * @var string $col
 * @var array $imageEnabled
 */

use admin\modules\image\widgets\assets\ImageUploadAsset;
use admin\modules\image\widgets\ImagesItem;
use kartik\widgets\FileInput;
use yii\helpers\Url;
ImageUploadAsset::register($this);
?>

<div class="form-group field-page-image">
    <?php if ($label) : ?>
        <label class="control-label" for="page-text"><?= $label ?>zzz</label>
    <?php endif; ?>
    <?php
    $initialPreview = [];
    $initialPreviewConfig = [];
   
    foreach ($images as $key => $image) {
        $initialPreview[] = ImagesItem::widget([
            'image' => $image,
            'modelInputName' => $modelInputName,
            'size' => $size,
            'key' => $image->id,
            'cover' => ($image_id == $image->id) ? 1 : 0,
            'enabled' => @$imageEnabled[$image->id],
        ]);
        $initialPreviewConfig[] = [
            'url' => Url::to(['/admin/image/ajax/image-hide']),
            'key' => $image->file_id,
        ];
    }
  
    echo FileInput::widget([
        'id' => $fileInputName,
        'name' => $fileInputName . '[]',
        'options' => [
            'multiple' => true,
            'accept' => 'image/jpeg'
        ],
        'language' => Yii::$app->language,
        'pluginOptions' => [
            'initialPreview' => $initialPreview,
            'initialPreviewConfig' => $initialPreviewConfig,
            'overwriteInitial' => false,
            'fileActionSettings' => [
                'showZoom' => false,
                'dragClass' => 'btn btn-xs btn-default',
                'dragSettings' => [
                    'sort' => true,
                    'draggable' => '.file-sortable',
                    'handle' => '.file-move',
                ],
            ],
            'previewFileType' => 'image',
            'uploadUrl' => Url::to(['/admin/image/ajax/images-upload']),
            'uploadExtraData' => [
                'modelInputName' => $modelInputName,
                'fileInputName' => $fileInputName,
                'size' => $size,
            ],
            'uploadAsync' => false,
            'showUpload' => false,
            'showRemove' => false,
            'showBrowse' => true,
            'showCaption' => false,
            'showClose' => false,
            'showPreview' => true,
            'dropZoneEnabled' => false,
            'removeIcon' => '<i class="fas fa-trash"></i> ',
            'layoutTemplates' => [
                'modalMain' => '',
                'modal' => '',
                'footer' => '<div class="card-header">{actions}</div>',
                'actions' => '{delete}',
                'progress' => '',
            ],
            'previewTemplates' => [
                'generic' => '                       
                        <div class="card p-2 kv-preview-thumb drag-handle-init file-sortable ' . $col . '" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}">
                        {footer}   
                        <div class="card-body kv-file-content">{content}</div>        
                        </div>',
                'image' => '
                    <div class="' . $col . '">
                    <div class=" card p-2 file-preview-frame kv-preview-thumb" id="{previewId}" data-fileindex="{fileindex}" data-template="{template}">
                    {footer}
                    <div class="card-body kv-file-content"> 
                        <img src="{data}" class="img-thumbnail kv-preview-data file-preview-image" title="{caption}" alt="{caption}" width="100%">
                        
                    </div>
                    
                    </div>
                    </div>',
            ],
        ],
        'pluginEvents' => [
            'filebatchselected' => 'function(event, files) { $("#' . $fileInputName . '").fileinput("upload"); }',
        ],
    ]);
    
    ?>
</div>
