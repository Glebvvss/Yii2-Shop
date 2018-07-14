<?php
  $this->title = 'E-SHOP | ' . $product['name_product'];
?>

<div class="container">
  <div class="products-page">
    <div class="products">
      <!-- Sidebar widget -->
      <?= app\components\SidebarWidget::widget() ?>

      <!-- Tags widget -->
      <?= app\components\TagsWidget::widget(['id_product' => $id_product]) ?>
    </div>

    <div class="new-product">
      <div class="col-md-5 zoom-grid">
        <img src="/images/product/<?=$product['img']?>" style="width: 100%;" data-imagezoom="true" class="img-responsive" alt="" />
      </div>
      <div class="col-md-7 dress-info">
        <div class="dress-name">
          <h3><?=$product['name_product']?></h3>
          <span>$<?= sprintf("%.2f", $product['price']/100); ?></span>
          <div class="clearfix"></div>
          <p><?=nl2br($product['about'])?></p>
        </div>
        <div class="span span1">
          <p class="left">BRAND</p>
          <p class="right"><?=$product['brands']['brand']?></p>
          <div class="clearfix"></div>
        </div>
        <div class="span span2">
          <p class="left">MADE IN</p>
          <p class="right"><?=$product['countries']['country']?></p>
          <div class="clearfix"></div>
        </div>
        <div class="span span3">
          <p class="left">COLOR</p>
          <p class="right"><?=$product['color']?></p>
          <div class="clearfix"></div>
        </div>
        <? if ( $product['sizes'] ) : ?>
        <div class="span span4">
          <p class="left">SIZE</p>
          <p class="right">
            <span class="selection-box">
              <select class="domains valid" name="domains">
                <?php foreach($product['sizes'] as $size) : ?>
                   <option><?=$size['sizes'][0]['size']?></option>
                <?php endforeach; ?>
              </select>
            </span>
          </p>
          <div class="clearfix"></div>
        </div>
        <? endif; ?>
        <div class="purchase">
          <a href="" class="add-to-cart" id="to-cart-<?= $product['id'] ?>">Purchase Now</a href="">
        <div class="social-icons">
          <ul>
            <li><a class="facebook1" href="#"></a></li>
            <li><a class="twitter1" href="#"></a></li>
            <li><a class="googleplus1" href="#"></a></li>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="reviews-tabs">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="">
        <ul class="hor-nav">
          <li class="active"> <a class="test" data-toggle="tab" href="#more-information"> More Information</a> </li>
          <li> <a href="#features" class="test" data-toggle="tab">Specifications</a> </li>
          <li> <a class="test" href="#reviews" data-toggle="tab">Reviews</a> </li>
        </ul>
      </div>
      <hr>
      <div class="tab-content responsive hidden-xs hidden-sm">
        <div class="tab-pane active" id="more-information">
          <p class="tab-text"><?=nl2br($product['about_large'])?></p>
        </div>
        <div class="tab-pane" id="features">
          <p class="tab-text"><?=nl2br($product['specifications'])?></p>
        </div>
        <div class="tab-pane" id="reviews">
          <div class="response" id="ajax-update" data-id="<?= $id_product ?>" >
            <?= app\components\ReviewWidget::widget(['id_product' => $id_product, 'reviews' => $reviews]); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= app\components\RelatedProductsWidget::widget(['id_product' => $id_product]); ?>
