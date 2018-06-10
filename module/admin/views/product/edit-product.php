<?

$this->title = 'admin | edit product';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1 class="caption-admin">Edit Product</h1><br>

<div>
    <div>
        <? $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">
            <!-- tags block -->
            <div id="tag-update-ajax" class="col-md-6" data-id="id_product-<?= $id_product ?>" style="margin-bottom: 80px;">
                <div style="float: left;">
                    <div class="form-group">
                        <label for="">Add Tag</label>
                        <input type="text" class="form-control custom-field" id="tag-value" style="width: 400px; margin-right: 20px;">
                    </div>
                </div>

                <div class="btn-tag">
                    <div href="" class="btn custom-btn" id="add-tag">Add Tag</div>
                </div>

                <br>
                <p><b>Tag List</b></p>
                <hr>
                <div class="admin-row-list-field">
                    <? foreach( $tag_list as $tag ) : ?>
                        <div class="admin-row-list">
                            <?= $tag['tags'][0]['tag'] ?>
                            <span class="delete-tag" id="del_tag-<?= $tag['tags'][0]['id'] ?>">
                                <i class="fas fa-times"></i>
                            </span>
                        </div>
                    <? endforeach; ?>
                </div>
                <hr>
            </div>
            <!-- /tags block -->

            <!-- sizes block -->
            <div id="size-update-ajax" class="col-md-6" data-id="id_product-<?= $id_product ?>" style="margin-bottom: 80px;">
                <div style="float: left;">
                    <div class="form-group">
                        <label for="">Add Size</label>
                        <input type="text" class="form-control custom-field" id="size-value" style="width: 400px; margin-right: 20px;">
                    </div>
                </div>

                <div class="btn-tag">
                    <div href="" class="btn custom-btn" id="add-size">Add Size</div>
                </div>

                <br>
                <p><b>Size List</b></p>
                <hr>
                <div>
                    <? foreach( $size_list as $size ) : ?>
                        <div class="admin-row-list">
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
        </div>


        <!-- select category -->
        <div class="row">
            <div class="col-md-12">
                <hr>
                <!--<h4 class="caption-admin">Select Category</h4>-->
            </div>
            <div id="select-category-ajax">
                <div class="form-group col-md-4">
                    <label for="">Main Category</label>
                    <select class="form-control custom-field" id="select-main-category-edit">
                        <!-- -->
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Type Category</label>
                    <select class="form-control custom-field" id="select-type-category-edit">
                        <!-- -->
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Category</label>
                    <select class="form-control custom-field" name="category" id="select-category-edit">
                        <!-- -->
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <!-- /select category -->

        <!-- -->
        <div class="row">
            <div class="col-md-4">
                <div class="col-md-12"><img class="img-edit-product" src="/web/images/product/<?= $product_info->img ?>"></div>
                <div class="col-md-12"><?= $f->field($edit_product_model, 'img')->fileInput([]); ?></div>
            </div>

            <div class="col-md-8"><?= $f->field($edit_product_model, 'name_product')->textInput(['value' => $product_info->name_product, 'class' => 'custom-field']); ?></div>
            <div class="col-md-8"><?= $f->field($edit_product_model, 'price')->textInput([ 'value' => $product_info->price, 'class' => 'custom-field']); ?></div>
            <div class="col-md-8"><?= $f->field($edit_product_model, 'color')->textInput([ 'value' => $product_info->color, 'class' => 'custom-field']); ?></div>
            <div class="col-md-8"><?= $f->field($edit_product_model, 'country')->label('Country')->textInput(['value' => $product_info->countries->country, 'class' => 'custom-field']); ?></div>
            <div class="col-md-8"><?= $f->field($edit_product_model, 'brand')->label('Brand')->textInput(['value' => $product_info->brands->brand, 'class' => 'custom-field']); ?></div>

            <div class="col-md-12"><?= $f->field($edit_product_model, 'about')->textarea(['rows' => 5, 'value' => $product_info->about, 'class' => 'custom-field']); ?></div>
            <div class="col-md-12"><?= $f->field($edit_product_model, 'about_large')->textarea(['rows' => 5, 'value' => $product_info->about_large, 'class' => 'custom-field']); ?></div>
            <div class="col-md-12"><?= $f->field($edit_product_model, 'specifications')->textarea(['rows' => 5, 'value' => $product_info->specifications, 'class' => 'custom-field']); ?></div>
        </div>
        <!-- -->

        <div class="parent-block col-md-12">
            <button type="submit" class="btn custom-btn btn-hor-center">Confirm Changes</button>
        </div>

        <? $f = ActiveForm::end() ?>
    </div>
</div>