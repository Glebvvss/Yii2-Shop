<div class="response" id="ajax-update" data-id="<?= $id_product ?>">
  <?= app\components\ReviewWidget::widget(['id_product' => $id_product, 'reviews' => $reviews]); ?>
</div>
