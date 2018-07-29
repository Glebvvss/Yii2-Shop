var idProductForDelete;

//open modal page
$('.pre-delete-product').click( function(e){
    e.preventDefault();
    var clickedId = $(this).attr('id');
    var clickedIdArray = clickedId.split('-');
    idProductForDelete = clickedIdArray[1];
    formId = $(this).attr('form');

    $('#overlay').fadeIn(400,
        function() {
            $('#modal_form_delete_product')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });
});

//close modal page
$('#dont-del-product, #overlay').click( function(){
    $('#modal_form_delete_product')
        .animate({opacity: 0, top: '45%'}, 200,
            function(){
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
});

//action delete product from db
$('#del-product').click(function() {
    var url = "/admin/product/delete-product?id_product=" + idProductForDelete;
    $(location).attr('href',url);
});
