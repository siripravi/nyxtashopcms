 <?php
 use admin\modules\products\models\Product;

use admin\modules\products\models\Value;
?>
 
 <?= $form->field($model, 'option_ids')->dropDownList(Product::getList(null), [
                'multiple' => true,
                'size' => 30,
                'options' => [
                    $model->id => [
                        'disabled' => true,
                    ]
                ]
            ]) ?>