function selectCategory() {

    $('#main-category').change(function () {
        var mainCategoryId = $('#main-category').val();
        $.ajax({
            url: 'http://basic/admin/admin/select-category-in-add-product-ajax',
            type: 'POST',
            data: {
                main_category_id: mainCategoryId
            },
            success: function(page) {
                $('#select-category-ajax').html(page);
                selectCategory();
            }
        });
    });

    $('#type-category').change(function () {
        var mainCategoryId = $('#main-category').val();
        var typeCategoryId = $('#type-category').val();
        $.ajax({
            url: 'http://basic/admin/admin/select-category-in-add-product-ajax',
            type: 'POST',
            data: {
                main_category_id: mainCategoryId,
                type_category_id: typeCategoryId
            },
            success: function(page) {
                $('#select-category-ajax').html(page);
                selectCategory();
            }
        });
    });

}selectCategory();