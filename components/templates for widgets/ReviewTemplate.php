
<? if ( !Yii::$app->user->isGuest ) : ?>
    <div class="">
        <textarea class="form-control" id="textarea-0" data-id="<?= $id_product ?>" style="resize: none;"></textarea>
        <button class="btn write-review add-review" id="add-subreview-to-0">Add Review</button>
    </div>
<? endif; ?>

<? function rec($tree_reviews, $margin) { ?>
    <? foreach( $tree_reviews as $review ) : ?>
        <div class="media response-info">

            <div class="review-left">
                <a href="#">
                    <img class="img-review" src="/images/user/<?= $review['users']['image_name'] ?>" alt="" />
                </a>
                <h5 class="username-review"><a href="#"><?= $review['users']['username'] ?></a></h5>
            </div>

            <div class="media-body response-text-right">
                <div class="text-review"><p><?= $review['review'] ?></p></div>
                <ul>
                    <li><?= Yii::$app->formatter->asDate($review['date'], 'medium') ?></li>
                    <? if ( !Yii::$app->user->isGuest ) : ?>
                        <li><p class="reviews-crud reply" id="add-<?=$review['id']?>">Reply</p></li>
                        <? if ( Yii::$app->user->getId() == $review['id_user'] ) : ?>
                            <li><p class="reviews-crud delete-review" id="delete-<?=$review['id']?>">Delete</p></li>
                        <? endif; ?>
                    <? endif; ?>
                </ul>

                <? if ( !Yii::$app->user->isGuest ) : ?>
                    <div class="review-on-review" id="crud-<?=$review['id']?>" data-id="<?= $id_product ?>">
                        <textarea class="form-control" style="resize: none;" id="textarea-<?=$review['id']?>"></textarea>
                        <button class="btn btn-xs write-subreview add-review" id="add-subreview-to-<?=$review['id']?>">Add Review</button>
                    </div>
                <? endif; ?>

            </div>
            <? if ( $review['subreviews'] ) : ?>
                <div style="padding-left: <?= $margin ?>px;" >
                    <? rec($review['subreviews'], $margin); ?>
                </div>
            <? endif; ?>
        </div>
    <? endforeach; ?>
<? } ?>

<? rec($tree_reviews, 70); ?>
