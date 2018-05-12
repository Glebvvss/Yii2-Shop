<?
    use yii\helpers\Html;
?>

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
<!-- -->
