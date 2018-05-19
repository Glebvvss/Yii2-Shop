(function selectCategoryTest() {
    $.getJSON('/json/admin/edit-product.json', function (data) {
        data.allCategories.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#select-main-category-edit');
            }
        });
    });
    updateSelectIdByChengedMain();
    updateSelectIdByChengedParent( 'select-type-category-edit', 'select-category-edit', 'category-option' );
}());

//utilities functions
function updateSelectIdByChengedMain() {
    defaultMainCategory();

    selectOptionsByParent( 'select-main-category-edit', 'select-type-category-edit', 'type-category-option' );
    defaultTypeCategory();

    selectOptionsByParent( 'select-type-category-edit', 'select-category-edit', 'category-option' );
    defaultCategory();

    $('#select-main-category-edit').change(function() {
        $('.type-category-option').remove();
        $('.category-option').remove();
        selectOptionsByParent( 'select-main-category-edit', 'select-type-category-edit', 'type-category-option' );
        selectOptionsByParent( 'select-type-category-edit', 'select-category-edit', 'category-option' );
    });
}

function updateSelectIdByChengedParent( parentSelectId, selectId, classOptions ) {
    $('#' + parentSelectId).change(function() {
        $('.' + classOptions).remove();
        selectOptionsByParent( parentSelectId, selectId, classOptions );
    });
}

function selectOptionsByParent( parentSelectId, selectId, classOptions ) {
    $.getJSON('/json/admin/edit-product.json', function(data){
        var parentId = $('#' + parentSelectId).val();
        data.allCategories.forEach(function(category) {
            if ( category.id_parent == parentId ) {
                $('<option>', {text: category.category, class: classOptions, value: category.id}).appendTo( '#' + selectId );
            }
        });
    });
}

function defaultMainCategory() {
    $.getJSON('/json/admin/edit-product.json', function(data){
        var mainCategory = data.selectedCategories.mainCategory;
        $('#select-main-category-edit option[value=' + mainCategory + ']').attr('selected', 'selected');
    });
}

function defaultTypeCategory() {
    $.getJSON('/json/admin/edit-product.json', function(data){
        var typeCategory = data.selectedCategories.typeCategory;
        $('#select-type-category-edit option[value=' + typeCategory + ']').attr('selected', 'selected');
    });
}

function defaultCategory() {
    $.getJSON('/json/admin/edit-product.json', function(data){
        var category = data.selectedCategories.category;
        $('#select-category-edit option[value=' + category + ']').attr('selected', 'selected');
    });
}
