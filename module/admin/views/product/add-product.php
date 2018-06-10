<?
    $this->title = 'admin | add product';
    use yii\widgets\ActiveForm;
?>

<h1 class="caption-admin">Add Product</h1>

<? $f = ActiveForm::begin() ?>
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
        <div class="col-md-6"><?= $f->field($add_product_model, 'name_product')->textInput(['class' => 'custom-field']); ?></div>
        <div class="col-md-6"><?= $f->field($add_product_model, 'price')->textInput(['class' => 'custom-field']); ?></div>
        <div class="col-md-6"><?= $f->field($add_product_model, 'img')->fileInput([]); ?></div>
        <div class="col-md-6"><?= $f->field($add_product_model, 'color')->textInput(['class' => 'custom-field']); ?></div>
        <div class="col-md-6"><?= $f->field($add_product_model, 'country')->textInput(['class' => 'custom-field']); ?></div>
        <div class="col-md-6"><?= $f->field($add_product_model, 'brand')->textInput(['class' => 'custom-field']); ?></div>

        <div class="col-md-12"><?= $f->field($add_product_model, 'about')->textarea(['rows' => 5, 'class' => 'custom-field']); ?></div>
        <div class="col-md-12"><?= $f->field($add_product_model, 'about_large')->textarea(['rows' => 5, 'class' => 'custom-field']); ?></div>
        <div class="col-md-12"><?= $f->field($add_product_model, 'specifications')->textarea(['rows' => 5, 'class' => 'custom-field']); ?></div>
    </div>
    <!-- -->

    <div class="parent-block col-md-12">
        <button type="submit" class="btn custom-btn btn-hor-center">Add Product</button>
    </div>
<? ActiveForm::end() ?>
