//adding functions
(function addTypeCategory() {
    $.getJSON('/json/admin/categories.json', function(data){
        data.forEach(function(category) {
            if ( category.id_parent == 0 ) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#add-type-category-main');
            }
        });
    });
}());

(function addCategory() {
    $.getJSON('/json/admin/categories.json', function (data) {
        data.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#add-category-main');
            }
        });
    });
    selectCategoryListByParent( 'add-category-main', 'add-category-type', 'add-category-type-option' );
}());


//deleting functions
(function deleteMainCategory() {
    $.getJSON('/json/admin/categories.json', function (data) {
        data.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#del-main-category-main');
            }
        });
    });
}());

(function deleteTypeCategory() {
    $.getJSON('/json/admin/categories.json', function (data) {
        data.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#del-type-category-main');
            }
        });
    });
    selectCategoryListByParent( 'del-type-category-main', 'del-type-category-type', 'del-type-category-type-option' );
}());

(function deleteCategory() {
    $.getJSON('/json/admin/categories.json', function (data) {
        data.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#del-category-main');
            }
        });
    });
    updateAllSelectsByMain();
    updateSelectIdByChengedParent( 'del-category-type', 'del-category', 'del-category-option' );
}());

(function selectCategoryInEditProductPage() {
    $.getJSON('/json/admin/categories.json', function (data) {
        data.forEach(function (category) {
            if (category.id_parent == 0) {
                $('<option>', {text: category.category, value: category.id}).appendTo('#select-main-category');
            }
        });
    });
    updateSelectIdByChengedMain();
    updateSelectIdByChengedParent( 'select-type-category', 'select-category', 'category-option' );
}());



//utilities functions
function updateSelectIdByChengedMain() {
    selectOptionsByParent( 'select-main-category', 'select-type-category', 'type-category-option' );
    selectOptionsByParent( 'select-type-category', 'select-category', 'category-option' );
    $('#select-main-category').change(function() {
        $('.type-category-option').remove();
        $('.category-option').remove();
        selectOptionsByParent( 'select-main-category', 'select-type-category', 'type-category-option' );
        selectOptionsByParent( 'select-type-category', 'select-category', 'category-option' );
    });
}

function updateAllSelectsByMain() {
    selectOptionsByParent( 'del-category-main', 'del-category-type', 'del-category-type-option' );
    selectOptionsByParent( 'del-category-type', 'del-category', 'del-category-option' );
    $('#del-category-main').change(function() {
        $('.del-category-type-option').remove();
        $('.del-category-option').remove();
        selectOptionsByParent( 'del-category-main', 'del-category-type', 'del-category-type-option' );
        selectOptionsByParent( 'del-category-type', 'del-category', 'del-category-option' );
    });
}

function updateSelectIdByChengedParent( parentSelectId, selectId, classOptions ) {
    $('#' + parentSelectId).change(function() {
        $('.' + classOptions).remove();
        selectOptionsByParent( parentSelectId, selectId, classOptions );
    });
}

function selectCategoryListByParent( parentSelectId, selectId, classOptions ) {
    selectOptionsByParent( parentSelectId, selectId, classOptions );
    updateSelectIdByChengedParent( parentSelectId, selectId, classOptions );
}

function selectOptionsByParent( parentSelectId, selectId, classOptions ) {
    $.getJSON('/json/admin/categories.json', function(data){
        var parentId = $('#' + parentSelectId).val();
        data.forEach(function(category) {
            if ( category.id_parent == parentId ) {
                $('<option>', {text: category.category, class: classOptions, value: category.id}).appendTo( '#' + selectId );
            }
        });
    });
}