<div class="product-listy">
  <h2>our Products</h2>
  <ul class="product-list">
    <li><a href="<?= Yii::$app->urlManager->createUrl(['shop/products']) ?>">All Products</a></li>
    <?php foreach( $categories as $category ) : ?>
      <li><a class="active" href="<?= Yii::$app->urlManager->createUrl(['shop/products', 'id_category' => $category->id]) ?>"><?= $category->category ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>
