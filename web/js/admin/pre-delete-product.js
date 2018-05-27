var formId, clickedId;

$('.pre-delete-product').click( function(e){
    e.preventDefault();
    clickedId = $(this).attr('id');
    formId = $(this).attr('form');
    $('#overlay').fadeIn(400,
        function() {
            $('#modal_form_delete_product')
                .css('display', 'block')
                .animate({opacity: 1, top: '50%'}, 200);
        });

    $('#del-product').click(function() {
        var url = "http://basic/admin/admin/delete-product?id_product=" + clickedId;
        $(location).attr('href',url);
    });

});

$('#dont-del-product, #overlay').click( function(){
    $('#modal_form_delete_product')
        .animate({opacity: 0, top: '45%'}, 200,
            function(){
                $(this).css('display', 'none');
                $('#overlay').fadeOut(400);
            }
        );
});