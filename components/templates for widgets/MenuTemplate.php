<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="<?= Yii::$app->urlManager->createUrl('site/index')?> ">Home</a></li>
        <? foreach($menu as $category) : ?>
            <li class="dropdown">
                <? if($category['id_parent'] == 0) : ?>
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><?=$category['category']?>  <? if($category['subcategories']) { echo "<b class=\"caret\"></b>"; }; ?></a>
                <? endif; ?>
                <? if($category['subcategories']) : ?>
                    <div class="dropdown-menu border-dropdown-menu">
                        <div class="raw">
                            <? foreach( $category['subcategories'] as $subcategory ) : ?>
                                <div class="block-category">
                                    <ul class="multi-column-dropdown">
                                        <h6><?=ucfirst($subcategory['category'])?></h6>
                                        <? if($subcategory['subcategories']) : ?>
                                            <? foreach($subcategory['subcategories'] as $subcategoryOfSub) : ?>
                                                <li><a href="<?=Yii::$app->urlManager->createUrl(['shop/products', 'id_category' => $subcategoryOfSub['id']])?>"><?=ucfirst($subcategoryOfSub['category'])?></a></li>
                                            <? endforeach; ?>
                                        <? endif; ?>
                                        <hr>
                                    </ul>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                <? endif; ?>
            </li>
        <? endforeach; ?>
        <li><a href="<?= Yii::$app->urlManager->createUrl('site/feedback') ?>">FEEDBACK</a></li>
    </ul>
</div>