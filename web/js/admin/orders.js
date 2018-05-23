(function filterOrders() {
    $('#filter-orders').change(function() {
        var filter = $('#filter-orders').val();
        $.ajax({
            url: 'http://basic/admin/admin/update-order-page-by-filter-ajax',
            type: 'POST',
            data: {
                filter: filter
            },
            success: function(page) {
                $('#ajax-update-orders-page').html(page);
            }
        });
    });
}());

function changeStatusOfOrder() {
    $('.status').change(function () {
        var filter = $('#filter-orders').val();
        var selectedId = $(this).attr('id');
        var orderId = selectedId.split('-');
        var status = $(this).val();
        $.ajax({
            url: 'http://basic/admin/admin/update-status-of-order-ajax',
            type: 'POST',
            data: {
                id_order: orderId[1],
                filter: filter,
                status: status
            },
            success: function (page) {
                $('#ajax-update-orders-page').html(page);
                changeStatusOfOrder();
            }
        });
    });
}changeStatusOfOrder();
