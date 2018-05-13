<?
$this->title = 'admin | add product';
//use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h1 class="caption-admin">Edit Product</h1>

<div class="add-products-body">
    <div class="add-product-form">
        <? $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <!-- -->
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
            <!-- -->
        </div>
        <!-- -->

        <!-- select category -->
        <div id="select-category-ajax">
            <hr>
            <div class="form-group">
                <label for="">Main Category</label>
                <?= Html::dropDownList('main_category', $main_category_id, $categories['main_category_list'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
            </div>

            <div class="form-group">
                <label for="">Type Category</label>
                <?= Html::dropDownList('type_category', $type_category_id, $categories['type_category_list'], ['class' => 'form-control select-category', 'id' => 'type-category']) ?>
            </div>

            <div class="form-group">
                <label for="">Category</label>
                <?= Html::dropDownList('category', null, $categories['category_list'], ['class' => 'form-control select-category', 'id' => 'category']) ?>
            </div>
            <hr>
        </div>
        <!-- /select category -->

        <!-- -->
        <?= $f->field($edit_product_model, 'name_product')->textInput(['value' => $product_info->name_product ]); ?>
        <?= $f->field($edit_product_model, 'price')->textInput(['value' => $product_info->price ]); ?>
        <?= $f->field($edit_product_model, 'img')->fileInput([]); ?>
        <?= $f->field($edit_product_model, 'color')->textInput(['value' => $product_info->color ]); ?>
        <?= $f->field($edit_product_model, 'country')->label('Country')->textInput(['value' => $product_info->countries->country]); ?>
        <?= $f->field($edit_product_model, 'brand')->label('Brand')->textInput(['value' => $product_info->brands->brand]); ?>
        <?= $f->field($edit_product_model, 'about')->textarea(['rows' => 5, 'value' => $product_info->about]); ?>
        <?= $f->field($edit_product_model, 'about_large')->textarea(['rows' => 5, 'value' => $product_info->about_large]); ?>
        <?= $f->field($edit_product_model, 'specifications')->textarea(['rows' => 5, 'value' => $product_info->specifications]); ?>
        <!-- -->

        <!-- -->

        <button type="submit" class="btn btn-primary">Submit</button>
        <? $f = ActiveForm::end() ?>
    </div>
</div>

<style>

    .admin-tag {
        display: inline-block;
        border: none;
        border-radius: 6px;

        margin: 3px;
        padding: 5px;
        background-color: #424242;
        color: white;
    }

    .btn-tag {
        padding-top: 20px;
        margin-left: 20px;
    }

</style>