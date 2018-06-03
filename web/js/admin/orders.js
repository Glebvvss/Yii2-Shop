function filterOrders() {
    $(document).ready(function() {
        $('#filter-orders').change(function() {
            var filter = $('#filter-orders').val();
            $.ajax({
                url: 'http://basic/admin/order/update-order-page-by-filter-ajax',
                type: 'GET',
                data: {
                    filter: filter
                },
                success: function(page) {
                    $('#ajax-update-orders-page').html(page);
                    changeStatusOfOrder();
                    openModalWindow();
                    filterOrders();
                }
            });
        });
    });
}filterOrders();

function changeStatusOfOrder() {
    $(document).ready(function() {
        $('.status').change(function () {
            var filter = $('#filter-orders').val();
            var selectedId = $(this).attr('id');
            var orderId = selectedId.split('-');
            var status = $(this).val();

            if ( status == 'cancel order') {
                $('#del-order').click(function () {
                    ajaxRequest(orderId[1], filter, status);
                });
            } else {
                ajaxRequest(orderId[1], filter, status);
            }
        });
    });
}changeStatusOfOrder();

function ajaxRequest(orderId, filter, status) {
    $.ajax({
        url: 'http://basic/admin/order/update-status-of-order-ajax',
        type: 'GET',
        data: {
            id_order: orderId,
            filter: filter,
            status: status
        },
        success: function (page) {
            $('#ajax-update-orders-page').html(page);
            changeStatusOfOrder();
            openModalWindow();
            filterOrders();
            closeModelWindow();
        }
    });
}

function openModalWindow() {
    $(document).ready(function() {
        $('.status').change( function(){
            var filter = $(this).val();
            if ( filter != 'cancel order' ) return;

            $('#overlay').fadeIn(400,
                function(){
                    $('#modal_form_delete_order')
                        .css('display', 'block')
                        .animate({opacity: 1, top: '50%'}, 200);
                });
        });
    });
}openModalWindow();

function closeModelWindow() {
    $('#del-order, #dont-del-order, #overlay').click( function(){
        $('#modal_form_delete_order')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });
}closeModelWindow();

