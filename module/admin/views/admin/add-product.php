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
            <?= $f->field($add_product_model, 'country'); ?>
            <?= $f->field($add_product_model, 'brand'); ?>
            <?= $f->field($add_product_model, 'about')->textarea(['rows' => 5]); ?>
            <?= $f->field($add_product_model, 'about_large')->textarea(['rows' => 5]); ?>
            <?= $f->field($add_product_model, 'specifications')->textarea(['rows' => 5]); ?>
            <!-- -->
            <div class="parent-block">
                <button type="submit" class="btn btn-primary btn-hor-center">Add Product</button>
            </div>
        <? ActiveForm::end() ?>
    </div>
</div>