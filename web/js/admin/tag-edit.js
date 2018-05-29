function addTag() {
    $('#add-tag').click(function () {
        var tag = $('#tag-value').val();
        var id = $('#tag-update-ajax').attr('data-id');
        var idProduct = id.split('-');
        $.ajax({
            url: 'http://basic/admin/product/add-tag-ajax',
            type: 'POST',
            data: {
                id_product: idProduct[1],
                tag: tag
            },
            success: function (page) {
                $('#tag-update-ajax').html(page);
                deleteTag();
                addTag();
            }
        });
    });
}addTag();

function deleteTag() {
    $('.delete-tag').click(function () {
        var idOfTag = $(this).attr('id');
        var idOfProduct = $('#tag-update-ajax').attr('data-id');

        var idTag = idOfTag.split('-');
        var idProduct = idOfProduct.split('-');

        $.ajax({
            url: 'http://basic/admin/product/delete-tag-ajax',
            type: 'POST',
            data: {
                id_product: idProduct[1],
                id_tag: idTag[1]
            },
            success: function (page) {
                $('#tag-update-ajax').html(page);
                deleteTag();
                addTag();
            }
        });
    });
}deleteTag();