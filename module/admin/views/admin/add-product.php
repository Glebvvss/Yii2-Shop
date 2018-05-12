<?
    $this->title = 'admin | add product';
    //use Yii;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<h1 class="caption-admin">Add Product</h1>

<div class="add-products-body">
    <div class="add-product-form">
        <? $f = ActiveForm::begin() ?>
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
            <?= $f->field($add_product_model, 'name_product'); ?>
            <?= $f->field($add_product_model, 'price'); ?>
            <?= $f->field($add_product_model, 'img')->fileInput([]); ?>
            <?= $f->field($add_product_model, 'color'); ?>
            <?= $f->field($add_product_model, 'id_country')->label('Country'); ?>
            <?= $f->field($add_product_model, 'id_brand')->label('Brand'); ?>
            <?= $f->field($add_product_model, 'about')->textarea(['rows' => 5]); ?>
            <?= $f->field($add_product_model, 'about_large')->textarea(['rows' => 5]); ?>
            <?= $f->field($add_product_model, 'specifications')->textarea(['rows' => 5]); ?>
            <!-- -->

            <!-- -->
            <div style="margin-bottom: 80px;">
                <div style="float: left;">
                    <div class="form-group">
                        <label for="">Add Tag</label>
                        <input type="text" class="form-control" style="width: 400px; margin-right: 20px;">
                    </div>
                </div>

                <div style="padding-top: 20px; margin-left: 20px;">
                    <button href="" class="btn">Add Tag</button>
                </div>

                <br>

                <div>
                    <div class="admin-tag">tag1 <i class="fas fa-times"></i></div>
                    <div class="admin-tag">tag2 <i class="fas fa-times"></i></div>
                    <div class="admin-tag">tag2 <i class="fas fa-times"></i></div>
                    <div class="admin-tag">tag2 <i class="fas fa-times"></i></div>
                </div>
                <!-- -->
            </div>
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

</style>