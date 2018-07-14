function modalForgetPassword() {
    $('#passwprd-forgot').click(function(event) {
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function(){
                $('#modal-forgot-password')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '30%'}, 200);
            });
    });

    $('#overlay').click( function(){
        $('#modal-forgot-password')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        });
}modalForgetEmail();
