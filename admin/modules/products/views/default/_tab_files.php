  <?php
  use admin\modules\image\widgets\FilesForm;
  ?>
  
  <?= FilesForm::widget([
                'files' => $files,
                'fileEnabled' => $model->fileEnabled,
                'fileName' => $model->fileName,
                'col' => 'col-sm-4 col-md-3',
                'modelInputName' => 'Product',
                'fileInputName' => 'files',
                'label' => null,
            ]) ?>