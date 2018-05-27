function updatePageProductsWithAjax() {
    //update page after changed parameters of select tags sort type and number products per page
    $('.ajax-update-parameter').change(function () {
        ajaxQueryOfUpdateSortProducts();
    });
    //update page after click on arrow of control directions
    $('#sort-direction').click( function() {
        changeDirectionOfSortProducts();
        ajaxQueryOfUpdateSortProducts();
    });
}updatePageProductsWithAjax();

function ajaxQueryOfUpdateSortProducts() {
    var sortDirection = $('#sort-direction').attr('data-id');
    var productsPerPage = $('#products-per-page').val();
    var idCategory = $('#update').attr('category');
    var sortType = $('#sort-type').val();
    var tag = $('#update').attr('tag');

    $.ajax({
        url: 'http://basic/shop/products',
        type: 'GET',
        data: {
            products_per_page: productsPerPage,
            sort_direction: sortDirection,
            id_category: idCategory,
            sort_type: sortType,
            tag: tag
        },
        success: function (page) {
            $('#update').html(page);
            updateAjaxVarsOnPage(productsPerPage, sortType);
            updatePageProductsWithAjax();
        }
    });
}

function updateAjaxVarsOnPage(productsPerPage, sortType) {
    $('#products-per-page').val(productsPerPage);
    $('#sort-type').val(sortType);
}

function changeDirectionOfSortProducts() {
    var sortDirection = $('#sort-direction').attr('data-id');
    if ( sortDirection === 'DESC' ) {
        $('#sort-direction').attr('data-id', 'ASC');
    }
    else if ( sortDirection === 'ASC' ) {
        $('#sort-direction').attr('data-id', 'DESC');
    }
}
