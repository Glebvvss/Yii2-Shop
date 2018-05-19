function addSize() {
    $('#add-size').click(function () {
        var size = $('#size-value').val();
        var id = $('#size-update-ajax').attr('data-id');
        var idProduct = id.split('-');

        $.ajax({
            url: 'http://basic/admin/admin/add-size-ajax',
            type: 'POST',
            data: {
                id_product: idProduct[1],
                size: size
            },
            success: function (page) {
                $('#size-update-ajax').html(page);
                deleteSize();
                addSize();
            }
        });
    });
}addSize();

function deleteSize() {
    $('.delete-size').click(function () {
        var idOfSize = $(this).attr('id');
        var idOfProduct = $('#size-update-ajax').attr('data-id');

        var idSize = idOfSize.split('-');
        var idProduct = idOfProduct.split('-');

        $.ajax({
            url: 'http://basic/admin/admin/delete-size-ajax',
            type: 'POST',
            data: {
                id_product: idProduct[1],
                id_size: idSize[1]
            },
            success: function (page) {
                $('#size-update-ajax').html(page);
                deleteSize();
                addSize();
            }
        });
    });
}deleteSize();
