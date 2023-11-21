<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 25.03.17
 * Time: 13:27
 */

namespace admin\modules\image\widgets;

use yii\base\Widget;

class ImagesForm extends Widget
{
    /** @var  */
    public $images;

    public $size = 'cover';

    public $fileInputName = 'images';

    public $modelInputName = 'Page';

    public $col = '';

    public $label = 'Images';

    public $image_id = null;

    public $imageEnabled = [];

    public function run()
    {
        return $this->render('imagesForm', [
            'images' => $this->images,
            'size' => $this->size,
            'fileInputName' => $this->fileInputName,
            'modelInputName' => $this->modelInputName,
            'col' => $this->col,
            'label' => $this->label,
            'image_id' => $this->image_id,
            'imageEnabled' => $this->imageEnabled,
        ]);
    }
}