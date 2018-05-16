<?
    use yii\helpers\Html;
?>

<h1 class="caption-admin">Categories</h1>
<div class="block-parent-center">
    <div class="category-container col-md-10 row">

        <div class="col-md-5 col-sm-12">
            <h3 style="text-align: center;">Add Category</h3>
            <div>
                <h5>Add Main Category</h5>
                <div class="row">
                    <div class="form-group col-md-10">
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="main-category" placeholder="Main Category">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>

            <h5>Add Type Category</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Main Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-5">
                    <label for="">Type Category</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-2" style="margin-top: 19px;">
                    <button class="btn btn-primary">Add</button>
                </div>
            </div>

            <h5>Add Category</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Main Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Type Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Category</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="block-parent-center">
                <button class="btn btn-primary center-button" style="width: 120px;">Add</button>
            </div>
        </div>


        <div class="col-md-2 hidden-sm" ></div>


        <div class="col-md-5 col-sm-12">
            <h3 style="text-align: center;">Delete Category</h3>
            <div>
                <h5>Delete Main Category</h5>
                <div class="row">
                    <div class="form-group col-md-10">
                        <label for="">Main Category</label>
                        <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" style="margin-top: 19px;">Delete</button>
                    </div>
                </div>
            </div>

            <h5>Delete Type Category</h5>
            <div class="row">
                <div class="form-group col-md-5">
                    <label for="">Main Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-5">
                    <label for="">Type Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="col-md-2" style="margin-top: 19px;">
                    <button class="btn btn-primary">Delete</button>
                </div>
            </div>

            <h5>Delete Category</h5>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Main Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Type Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>

                <div class="form-group col-md-4">
                    <label for="">Category</label>
                    <?= Html::dropDownList('main_category', null, ['asd', 'asdasd'], ['class' => 'form-control select-category', 'id' => 'main-category']) ?>
                </div>
            </div>

            <div class="block-parent-center">
                <button class="btn btn-primary center-button" style="width: 120px;">Delete</button>
            </div>
        </div>

    </div>
</div>

<style>

    .block-parent-center {
        display: flex;
    }

    .center-button {
        margin-left: auto;
        margin-right: auto;
    }

    .category-container {
        display: flex;
        margin-top: 50px;
        margin-left: auto;
        margin-right: auto;
    }

</style>