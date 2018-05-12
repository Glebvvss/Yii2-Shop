//add product tp cart
$('.add-to-cart').click(function() {
    var id = $(this).attr('id');
    id = id.split('-');
    var idProduct = id[2];

    $.ajax({
        url: 'http://basic/cart/add-to-cart-ajax',
        type: 'GET',
        data: {
            id_product: idProduct
        },
        dataType: 'json',
        success: function(obj) {
            var cartSum = parseInt(obj.cartSum)/100;
            $('#sum-of-cart').text('$' + cartSum.toFixed(2));
            $('#count-of-cart').text(obj.cartQty);
        }
    });
});

function removeFromCart() {
    $('.remove-position').click(function () {
        var clickedId = $(this).attr('id');
        var arrayClickedId = clickedId.split('-');
        var idProduct = arrayClickedId[1];
        $.ajax({
            url: 'http://basic/cart/delete-from-cart-ajax',
            type: 'POST',
            dataType: 'json',
            data: {
                id_product: idProduct
            },
            success: function (obj) {
                $('#ajax-update-cart').html(obj.template);
                var cartSum = parseInt(obj.cartSum)/100;
                $('#sum-of-cart').text('$' + cartSum.toFixed(2));
                $('#count-of-cart').text(obj.cartQty);
                removeFromCart();
            }
        });
    });
}removeFromCart();


