<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 28.06.17
 * Time: 11:30
 */

namespace admin\modules\image\widgets;

use yii\base\Widget;

class ImageItem extends Widget
{
    /** @var $image dench\image\models\Image */
    public $image;

    public $modelInputName;

    public $size;

    public function run()
    {
        return $this->render('imageItem', [
            'image' => $this->image,
            'modelInputName' => $this->modelInputName,
            'size' => $this->size,
        ]);
    }
}