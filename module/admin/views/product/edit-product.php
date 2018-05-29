<?

$this->title = 'admin | edit product';

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1 class="caption-admin">Edit Product</h1>

<div class="add-products-body">
    <div class="add-product-form">
        <? $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <!-- tags block -->
        <div id="tag-update-ajax" data-id="id_product-<?= $id_product ?>" style="margin-bottom: 80px;">
            <div style="float: left;">
                <div class="form-group">
                    <label for="">Add Tag</label>
                    <input type="text" class="form-control" id="tag-value" style="width: 400px; margin-right: 20px;">
                </div>
            </div>

            <div class="btn-tag">
                <div href="" class="btn btn-primary" id="add-tag">Add Tag</div>
            </div>

            <br>
            <p><b>Tag List</b></p>
            <hr>
            <div>
                <? foreach( $tag_list as $tag ) : ?>
                    <div class="admin-tag">
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

        <!-- select category -->
        <div id="select-category-ajax">
            <hr>
            <div class="form-group">
                <label for="">Main Category</label>
                <select class="form-control" id="select-main-category-edit">

                    <!-- -->

                </select>
            </div>

            <div class="form-group">
                <label for="">Type Category</label>
                <select class="form-control" id="select-type-category-edit">

                    <!-- -->

                </select>
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category" id="select-category-edit">

                    <!-- -->

                </select>
            </div>
            <hr>
        </div>
        <!-- /select category -->

        <!-- -->
        <div class="form-admin">
            <?= $f->field($edit_product_model, 'name_product')->textInput(['value' => $product_info->name_product ]); ?>
            <?= $f->field($edit_product_model, 'price')->textInput([ 'value' => $product_info->price ]); ?>
            <img class="img-edit-product" src="/web/images/product/<?= $product_info->img ?>">
            <?= $f->field($edit_product_model, 'img')->fileInput([]); ?>
            <?= $f->field($edit_product_model, 'color')->textInput([ 'value' => $product_info->color ]); ?>
            <?= $f->field($edit_product_model, 'country')->label('Country')->textInput(['value' => $product_info->countries->country]); ?>
            <?= $f->field($edit_product_model, 'brand')->label('Brand')->textInput(['value' => $product_info->brands->brand]); ?>
            <?= $f->field($edit_product_model, 'about')->textarea(['rows' => 5, 'value' => $product_info->about]); ?>
            <?= $f->field($edit_product_model, 'about_large')->textarea(['rows' => 5, 'value' => $product_info->about_large]); ?>
            <?= $f->field($edit_product_model, 'specifications')->textarea(['rows' => 5, 'value' => $product_info->specifications]); ?>
        </div>
        <!-- -->

        <div class="parent-block">
            <button type="submit" class="btn btn-primary btn-hor-center">Confirm Changes</button>
        </div>
        <? $f = ActiveForm::end() ?>
    </div>
</div>