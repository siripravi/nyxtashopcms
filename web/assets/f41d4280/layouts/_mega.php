<?php
use yii\widgets\Menu;
use app\models\Category;
?>

<div class="mega-content px-4">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12 col-sm-4 col-md-3 py-4">
                      <h5>Pages</h5>
                      <?php
                        /** @var $categories Category[] */
                        $categories = !Yii::$app->cache->exists('_categories-' . Yii::$app->language) ? Category::getMain() : [];
                        $items = [];
                        foreach ($categories as $category) {
                            $items[$category->id] = [
                                'label' => $category->name,
                                'url' => (count($category->categories)) ? ['category/pod', 'slug' => $category->slug] : ['category/view', 'slug' => $category->slug],
                                'options' => [
                                'tag' => false,
                            ],
                        ];
                        }
                        echo Menu::widget([
                            'items' => $items,
                            'linkTemplate' => '<a class="list-group-item text-center" href="{url}">{label}</a>',
                           'itemOptions' => ['class' => 'list-group-item'],
                            'options' => [
                                'tag' => 'div',
                                //'class' => 'dropdown-menu rounded-0 w-100',
                                'class' => 'list-group',
                               // 'aria-labelledby' => "dropdownButton"
                            ],
                        ]);
                        ?> 
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 py-4">
                      <h5>Card</h5>
                      <div class="card">
                  <img src="https://via.placeholder.com/320x180" class="img-fluid" alt="image">
                  <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  </div>
                </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-3 py-4">
                      <h5>Lot of Pages</h5>
                      <p>Lorem ipsum dolo sit achmet muhamed borlan de irtka.
                    </p></div>
                    <div class="col-12 col-sm-12 col-md-3 py-4">
                      <h5>Damn, so many</h5>
                      <div class="list-group">
                        <a class="list-group-item" href="#">Accomodations</a>
                        <a class="list-group-item" href="#">Terms &amp; Conditions</a>
                        <a class="list-group-item" href="#">Privacy</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>