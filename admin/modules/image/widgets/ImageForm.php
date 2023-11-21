<?php
/**
 * Created by PhpStorm.
 * User: siripravi
 * Date: 25.03.2022
 * Time: 13:27
 */

namespace admin\modules\image\widgets;

use yii\base\Widget;

class ImageForm extends Widget
{
    
    public $image;

    public $size = 'cover';

    public $fileInputName = 'file';

    public $modelInputName = 'Page';

    public $col = '';

    public $label = 'Image';

    public function run()
    {
        return $this->render('imageForm', [
            'image' => $this->image,
            'size' => $this->size,
            'fileInputName' => $this->fileInputName,
            'modelInputName' => $this->modelInputName,
            'col' => $this->col,
            'label' => $this->label,
        ]);
    }
}