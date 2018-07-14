<?php
  $this->title = 'E-SHOP | Categories';
  use yii\widgets\Pjax;
?>

<div>
  <div class="container">
    <div class="products-page">
      <div class="products">
        <!-- Sidebar widget -->
        <?= app\components\SidebarWidget::widget() ?>
        <!-- Tags widget -->
        <?= app\components\TagsWidget::widget(['id_category' => $id_category]) ?>
      </div>

      <div class="new-product">
          <div id="update" category="<?= $id_category ?>" tag="<?= $tag ?>">
            <div class="caption-category">
              <?
                if ( $tag ) {
                    echo '<h2> Products By Tag - '. ucfirst($tag) . '</h2>';
                  } else if ( !empty($category) ) {
                    echo '<h2>'. $category->category . '</h2>';
                  } else {
                    echo '<h2>All Products</h2>';
                }
              ?>
            </div>

            <div>
              <div class="sort">
                <div class="sort-by center-subheader" style="float: left;">
                  <label>Sort By</label>
                  <select class="ajax-update-parameter" id="sort-type">
                    <option value="position" <?php if($sort_type == 'position') echo 'selected' ?>>
                      Position            
                    </option>
                    <option value="name" <?php if($sort_type == 'name') echo 'selected' ?>>
                      Name               
                    </option>
                    <option value="price" <?php if($sort_type == 'price') echo 'selected' ?>>
                      Price               
                    </option>
                  </select>

                  <? if( $sort_direction == 'DESC' || !$sort_direction ) : ?>
                    <i class="fas fa-angle-up" style="cursor: pointer" id="sort-direction"  data-id="DESC"></i>
                  <? else : ?>
                    <i class="fas fa-angle-down" style="cursor: pointer" id="sort-direction" data-id="ASC"></i>
                  <? endif; ?>
                </div>

                <div class="pagination-products">
                  <ul class="women_pagenation">
                    <li style="padding-top: 1px;">Page:</li>
                      <li>
                        <?php
                          echo yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                            'options' => [
                                'class' => ''
                            ],
                          ]);
                        ?>
                      </li>
                    </ul>
                  </div>
              </div>
              <br>
              <div class="clearfix"></div>
              <br>
            </div>
              <div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
                <div class="pages">
                  <div class="limiter visible-desktop">
                    <label>Show</label>
                    <select class="ajax-update-parameter" id="products-per-page">
                      <option value="9" selected="selected">
                        9                
                      </option>
                      <option value="15">
                        15                
                      </option>
                      <option value="30">
                        30                
                      </option>
                    </select> per page
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>

                  <? if ( !$products ) : ?>
                    <p style="color: #B9B4B5;">No products in this category...</p>
                  <? endif; ?>

                  <div class="row">
                      <?php foreach($products as $product) : ?>
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="cbp-vm-image" href="<?=Yii::$app->urlManager->createUrl(['shop/product-single', 'id_product' => $product['id']])?>">
                        <div class="simpleCart_shelfItem">
                          <div class="view view-first">
                            <div class="inner_content clearfix">
                              <div class="product_image">
                              <img src="/images/product/<?=$product['img']?>" style="width: 100%;" class="img-responsive" alt=""/>
                              <div class="mask">
                                <div class="info">Quick View</div>
                              </div>
                              <div class="product_container">
                                <div class="cart-left">
                                  <p class="title"><?=$product['name_product']?></p>
                                </div>
                                <div class="pricey"><span class="item_price">$<?= sprintf("%.2f", $product['price']/100);  ?></span></div>
                                <div class="clearfix"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                    <div class="cbp-vm-details">
                      <?=$product['about']?>
                    </div>
                    <div class="down-block">
                      <div class="button-cart">
                    <button class="add-to-cart button-to-cart transition" id="to-cart-<?= $product['id'] ?>" >Add to cart</button>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>



<?= app\components\MostPopularWidget::widget(); ?>
