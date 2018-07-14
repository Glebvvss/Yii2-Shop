<? if ( !empty($tag_list) ) : ?>
  <div class="product-listy">
    <div class="tags">
      <h4 class="tag_head">Tags Widget</h4>
      <ul class="tags_links">
        <? foreach($tag_list as $tag) : ?>
        <li><a href="<?= Yii::$app->urlManager->createUrl(['shop/products', 'tag' => $tag]) ?>"><?= $tag ?></a></li>
        <? endforeach; ?>
      </ul>
    </div>
  </div>
<? endif; ?>
