//add product tp cart
$('.add-to-cart').click(function(e) {
    e.preventDefault();
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
            addToCartResultMessage();
            var cartSum = parseInt(obj.cartSum)/100;
            $('#sum-of-cart').text('$' + cartSum.toFixed(2));
            $('#count-of-cart').text(obj.cartQty);
        }
    });
});


function addToCartResultMessage(result) {
    showAddToCartResultMessage();
    setTimeout( function() {
        hideAddToCartResultMessage();
    }, 2000 );
}

function showAddToCartResultMessage() {
    $('#add-to-cart-message').animate({opacity: 1}, 500)
        .css('display', 'block');
}

function hideAddToCartResultMessage() {
    $('#add-to-cart-message').animate({opacity: 0}, 500);

    setTimeout(function(id) {
        $('#add-to-cart-message').css('display', 'none');
    }, 500);
}
//end add to cart

function removeFromCart() {
    $('.remove-position').click(function (e) {
        e.preventDefault();
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
                confirmOrderModal();
                changeQtyByProduct();
            }
        });
    });
}removeFromCart();

function confirmOrderModal() {
    $('#open-modal-order-page').click(function(event) {
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function(){
                $('#modal-confirm-order')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('#overlay').click( function(){
        $('#modal-confirm-order')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        });

}confirmOrderModal();

function changeQtyByProduct() {
    $('.cart-qty-input').change(function() {
        var idProduct = $(this).attr('product');
        var qty = $(this).val();

        $.ajax({
            url: 'http://basic/cart/change-qty-product',
            type: 'GET',
            data: {
                id_product: idProduct,
                qty: qty
            }
        });
    });
}changeQtyByProduct();