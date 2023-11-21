<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 19.12.17
 * Time: 16:00
 */

namespace app\modules\modal;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

class Modal extends Widget
{
    public $offCanvasId = 'offcanvasCart';
    public $modalClass = "modal-load";
    public $options;

    public $titleTag = 'h5';

    public $titleOptions;

    public $size = 'modal-lg';

    public $close = true;

    public $center = false;

    public $backdrop = 'false'; // 'true'|'false'|'"static"'

    public $keyboard = 'true';

    public $scroll = 'true';

    public function run()
    {
        $view = $this->getView();

        $js = <<<JS

function offCanvasLoad(obj, data) {    
    renderData(obj, data.title, '.offcanvas-title');
    renderData(obj, data.body, '.offcanvas-body');
   // renderData(obj, data.footer, '.offCanvas-footer');
   // obj.find('.modal-dialog').removeClass('modal-lg').removeClass('modal-sm').addClass(data.size);
   obj.setAttribute("class", "offcanvas offcanvas-end");   //console.log(obj);
}

function renderData(obj, data, sel) {
   
    const elm =  obj.querySelector(sel);
   
    if (data) {       
        elm.innerHTML = data; elm.display = "block";
    } else {
       // elm.display = "none";
    }
    
}

function openOffCanvas(action = null, config = {}) {  
   
    if (action === null) {
      /*  var myOffcanvas = document.getElementById('{$this->offCanvasId}');
        
        offCanvasLoad(obj, config);
        if (typeof config.backdrop !== 'undefined') {
            config.backdrop = {$this->backdrop};
        }
        if (typeof config.keyboard !== 'undefined') {
            config.keyboard = {$this->keyboard};
        }
        obj.modal({
            show: true,
            backdrop: config.backdrop,
            keyboard: config.keyboard
        });*/
    } else {  // alert(action);  
        $.getJSON(action, function(data){
            var myOffcanvas = document.getElementById('{$this->offCanvasId}');
            var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas);
            data = $.extend(data, config);
            offCanvasLoad(myOffcanvas, data);
            if (!data.backdrop) {
                data.backdrop = {$this->backdrop};
            }
            if (!data.keyboard) {
                data.keyboard = {$this->keyboard};
            }
            if (!data.scroll) {
                data.scroll = {$this->scroll};
            }
           /* var bsOffcanvas = new bootstrap.Offcanvas({
                backdrop: data.backdrop,
                keyboard: data.keyboard,
                scroll : data.scroll
            });*/

           bsOffcanvas.show();
        });
    }
}
JS;
        $view->registerJs($js, View::POS_END);

        $js = <<<JS
        var myOffcanvas = document.getElementById('{$this->offCanvasId}');

       // myOffcanvas.addEventListener('shown.bs.offcanvas', function (e) {
        $(document).on('click', '.btn-buy', function(e){
            e.stopPropagation();
            //alert("showing..");
            var config = {
               
                body: $(this).attr('data-modal-body'),
                footer: $(this).attr('data-modal-footer'),
               
            };
            openOffCanvas("/bag/offcanvas", config);
});

$(document).on('click', '#{$this->offCanvasId} button[type="submit"]', function(){
    $('#{$this->offCanvasId} form').trigger('beforeSubmit');
});
$(document).on('beforeSubmit', '#{$this->offCanvasId} form', function(){
    var form = $(this);
    $.post(form.attr('action'), form.serialize(), function(data){
        offCanvasLoad($('#{$this->offCanvasId}'), data);
    }, 'json');
    return false;
});

JS;
        $view->registerJs($js);

        Html::addCssClass($this->titleOptions, 'modal-title');

        Html::addCssClass($this->options, $this->offCanvasId);

        return $this->render('offcanvas', [
            'offCanvasId' => $this->offCanvasId
        ]);
    }
}
