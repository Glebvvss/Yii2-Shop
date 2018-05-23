(function changeStatusOnOrderDetailsPage() {
    $('.status').change(function () {
        var selectedId = $(this).attr('id');
        var orderId = selectedId.split('-');
        var status = $(this).val();
        $.ajax({
            url: 'http://basic/admin/admin/update-status-order-details-ajax',
            type: 'POST',
            data: {
                id_order: orderId[1],
                status: status
            }
        });
    });
}());
