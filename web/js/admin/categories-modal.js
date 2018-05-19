var formId;

(function openModalWindow() {
    $(document).ready(function() {
        $('.button-form').click( function(event){
            event.preventDefault();
            formId = $(this).attr('form');
            $('#overlay').fadeIn(400,
                function(){
                    $('#modal_form')
                        .css('display', 'block')
                        .animate({opacity: 1, top: '50%'}, 200);
                });
        });

        $('#modal_close, #overlay').click( function(){
            $('#modal_form')
                .animate({opacity: 0, top: '45%'}, 200,
                    function(){
                        $(this).css('display', 'none');
                        $('#overlay').fadeOut(400);
                    }
                );
        });
    });
}());

(function submitDeleteForms() {
    $('#del-with-products').click(function () {
        $('<input>', {
            type: 'text',
            name: 'productsDelete',
            value: 1,
            id: 'products-delete-by-category'
        }).appendTo('#' + formId);
        $('#products-delete-with-category').hide();
        $('#' + formId).submit();
    });

    $('#del-category-only').click(function () {
        $('#' + formId).submit();
    });
}());