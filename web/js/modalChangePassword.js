function modalChangePassword() {
    $('#change-password-btn').click(function(event) {
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function(){
                $('#modal-change-password')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '30%'}, 200);
            });
    });

    $('#overlay').click( function(){
        $('#modal-change-password')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
        });
}modalChangePassword();