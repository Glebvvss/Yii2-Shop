<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="<?= Yii::$app->urlManager->createUrl('site/index')?> ">Home</a></li>

        <?php foreach($menu as $category) : ?>
            <li class="dropdown">
                <?php if($category['id_parent'] == 0) : ?>
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><?=$category['category']?>  <?php if($category['subcategories']) { echo "<b class=\"caret\"></b>"; }; ?></a>
                <?php endif; ?>

                <?php if($category['subcategories']) : ?>
                    <ul class="dropdown-menu multi-column menuxa">
                        <div class="row">
                            <?php foreach( $category['subcategories'] as $subcategory ) : ?>
                                <div class="col-sm-6">
                                    <ul class="multi-column-dropdown">
                                        <h6><?=$subcategory['category']?></h6>
                                        <?php if($subcategory['subcategories']) : ?>
                                            <?php foreach($subcategory['subcategories'] as $subcategoryOfSub) : ?>
                                                <li><a href="<?=Yii::$app->urlManager->createUrl(['shop/products', 'id_category' => $subcategoryOfSub['id']])?>"><?=$subcategoryOfSub['category']?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </ul>
                <?php endif; ?>

            </li>
        <?php endforeach; ?>

        <li><a href="<?= Yii::$app->urlManager->createUrl('site/contact') ?>">CONTACT</a></li>
    </ul>
</div>
