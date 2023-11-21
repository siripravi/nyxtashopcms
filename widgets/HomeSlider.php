<?php

namespace app\widgets;
use Yii;
use yii\bootstrap4\BootstrapPluginAsset;
use yii\bootstrap5\Html;
use yii\bootstrap4\Widget;
use yii\helpers\ArrayHelper;
use siripravi\slideradmin\models\Slider;
use siripravi\slideradmin\models\SliderImage;

class HomeSlider extends \yii\bootstrap5\Carousel
{
    public $thumbnails = [];
	//public $slides = [];
	
	public function init(){
		parent::init();
		
		$model = Slider ::find()-> one();
		$slides = $model->slides;
		foreach($slides as $sld){
			if (($image = SliderImage::find()->where(['id' => $sld->id])->multilingual()->one()) !== null) {
			$this->items[] = [
        'content' => '<div class="home_slider_container">
		                <div class="row p-0"><div class="mx-auto">'.
		       $image->render($sld->filename,"large",["class" => "slider-img"]).	
                        '</div>',
        'caption' => '<div class="col-12">'.
		                Html::tag('h1', $image->title,['class'=>'h1 text-success']).
                       '<h3 class="h2"></h3><p>'.$image->html.'</p></div></div></div>',		
		'captionOptions' => ['class' => ['col-lg-12 mb-0 d-flex align-items-center']],
		
    ];
			}	
		}
	}
}