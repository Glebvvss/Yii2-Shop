
(function selectCategoryProduct() {
    $('#select-category-product').change(function() {
        var idCategory = $('#select-category-product').val();

        $.ajax({
            url: '/admin/product/products',
            type: 'POST',
            data: {
                id_category: idCategory
            },
        });
    });
}());
