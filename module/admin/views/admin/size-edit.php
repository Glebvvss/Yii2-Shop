<!-- sizes block -->
<div id="size-update-ajax" data-id="id_product-<?= $id_product ?>" style="margin-bottom: 80px;">
    <div style="float: left;">
        <div class="form-group">
            <label for="">Add Size</label>
            <input type="text" class="form-control" id="size-value" style="width: 400px; margin-right: 20px;">
        </div>
    </div>

    <div class="btn-tag">
        <div href="" class="btn btn-primary" id="add-size">Add Size</div>
    </div>

    <br>
    <p><b>Size List</b></p>
    <hr>
    <div>
        <? foreach( $size_list as $size ) : ?>
            <div class="admin-tag">
                <?= $size['sizes'][0]['size'] ?>
                <span class="delete-size" id="del_size-<?= $size['sizes'][0]['id'] ?>">
                            <i class="fas fa-times"></i>
                        </span>
            </div>
        <? endforeach; ?>
    </div>
    <hr>
</div>
<!-- /sizes block -->