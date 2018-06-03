<?
    $this->title = 'Category Editor';
    use yii\widgets\ActiveForm;

?>

<h1 class="caption-admin">Categories</h1>
<div class="block-parent-center">
    <div class="category-container col-md-10 row">

        <div class="col-md-5 col-sm-12">
            <h3 style="text-align: center;">Add Category</h3>
            <? ActiveForm::begin(['action' =>['/admin/category/add-category']]); ?>
            <h5>Add Main Category</h5>
            <div class="row">
                <div class="form-group col-md-10">
                    <input name="category" type="text" class="form-control" id="add-main-category" aria-describedby="main-category" placeholder="Main Category">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" type="submit" id="add-main-category-btn">Add</button>
                </div>
            </div>
            <? ActiveForm::end(); ?>

            <? ActiveForm::begin(['action' =>['/admin/category/add-category']]); ?>
            <h5>Add Type Category</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Main Category</label>
                    <select class="form-control" id="add-type-category-main" name="parentId">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-5">
                    <label for="">Type Category</label>
                    <input name="category" type="text" class="form-control">
                </div>

                <div class="col-md-2" style="margin-top: 19px;">
                    <button class="btn btn-primary">Add</button>
                </div>
            </div>
            <? ActiveForm::end(); ?>

            <? ActiveForm::begin(['action' =>['/admin/category/add-category']]); ?>
            <h5>Add Category</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Main Category</label>
                    <select class="form-control" id="add-category-main" name="">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Type Category</label>
                    <select class="form-control" id="add-category-type" name="parentId">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Category</label>
                    <input name="category" type="text" id="add-category-input" class="form-control">
                </div>
            </div>
            <div class="block-parent-center">
                <button type="submit" class="btn btn-primary center-button" style="width: 120px;">Add</button>
            </div>
            <? ActiveForm::end(); ?>
        </div>


        <div class="col-md-2 hidden-sm" ></div>


        <div class="col-md-5 col-sm-12">
            <? ActiveForm::begin([
                'id' => 'del-main-category-form',
                'action' =>['/admin/category/delete-category']
            ]); ?>
            <h3 style="text-align: center;">Delete Category</h3>
            <div>
                <h5>Delete Main Category</h5>
                <div class="row">
                    <div class="form-group col-md-10">
                        <label for="">Main Category</label>
                        <select name="category" class="form-control" id="del-main-category-main">

                            <!--  -->

                        </select>
                    </div>
                    <div class="col-md-2">
                        <button form="del-main-category-form" type="submit" class="btn btn-primary button-form" style="margin-top: 19px;">Delete</button>
                    </div>
                </div>
            </div>
            <? ActiveForm::end(); ?>

            <? ActiveForm::begin([
                'id' => 'del-type-category-form',
                'action' =>['/admin/category/delete-category']
            ]); ?>
            <h5>Delete Type Category</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Main Category</label>
                    <select class="form-control" id="del-type-category-main">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-5">
                    <label for="">Type Category</label>
                    <select name="category" class="form-control" id="del-type-category-type">

                        <!--  -->

                    </select>
                </div>

                <div class="col-md-2" style="margin-top: 19px;">
                    <button form="del-type-category-form" type="submit" class="btn btn-primary button-form">Delete</button>
                </div>
            </div>
            <? ActiveForm::end(); ?>

            <? ActiveForm::begin([
                'id' => 'del-category-form',
                'action' =>['/admin/category/delete-category']
            ]); ?>
            <h5>Delete Category</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Main Category</label>
                    <select class="form-control" id="del-category-main" name="">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Type Category</label>
                    <select class="form-control" id="del-category-type" name="">

                        <!--  -->

                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Category</label>
                    <select name="category" class="form-control" id="del-category">

                        <!--  -->

                    </select>
                </div>
            </div>

            <div class="block-parent-center">
                <button type="submit" id="" form="del-category-form" class="btn btn-primary center-button button-form" style="width: 120px;">Delete</button>
            </div>
            <? ActiveForm::end(); ?>
        </div>

    </div>
</div>

<div class="modal_form" id="modal_form_delete_category">
    <p>Remember! Deleting categories can cause the products in this category to lose the category ID. Are you agree delete category?</p>
    <div class="down-block">
        <div class="center-buttons">
            <button id="del-category-btn" class="btn">Yes</button>
            <button id="no-del-category-btn" class="btn">No</button>
        </div>
    </div>
</div>
<div id="overlay"></div>