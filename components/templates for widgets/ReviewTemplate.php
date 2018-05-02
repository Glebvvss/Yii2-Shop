<textarea class="form-control" style="resize: none;"></textarea>

<? function rec($tree_reviews, $margin) { ?>
    <? foreach( $tree_reviews as $review ) : ?>
        <div class="media response-info">
            <div class="media-left response-text-left">
                <a href="#">
                    <img class="media-object" src="images/icon1.png" alt="" />
                </a>
                <h5><a href="#">Username</a></h5>
            </div>
            <div class="media-body response-text-right">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,There are many variations of passages of Lorem Ipsum available,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <ul>
                    <li>MARCH 21, 2015</li>
                    <li><p class="reply" id="review-<?=$review['id']?>">Reply</p></li>
                </ul>

                <div class="review-on-review">
                    <textarea class="form-control" style="resize: none;" id="textarea-<?=$review['id']?>"></textarea>
                </div>
            </div>
            <? if ( $review['subreviews'] ) : ?>
                <div style="padding-left: <?= $margin ?>px;" >
                    <? rec($review['subreviews'], $margin + 70); ?>
                </div>
            <? endif; ?>
        </div>
    <? endforeach; ?>
<? } ?>

<? rec($tree_reviews, 70); ?>

<style>
    .reply {
        color: #887f66;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }
</style>