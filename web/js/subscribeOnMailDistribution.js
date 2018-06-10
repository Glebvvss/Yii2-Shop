$('#modal-mailing-list-res-true').hide();

$(document).ready(function() {
    $('#subscribe-mails').click(function() {
         var email = $('#email-for-distribution').val();
             $.ajax({
             url: '/site/join-to-mailing-list',
             type: 'POST',
             data: {
                email: email
             },
             success: function(result) {
                 resultOfJoinMailingToList(result);
             }
         });
    });
});

function resultOfJoinMailingToList(result) {

    var id;
    if ( result == true ) {
        id = '#modal-mailing-list-res-true';
    } else {
        id = '#modal-mailing-list-res-false';
    }

    showMessage(id);
    setTimeout( function() {
        hideMessage(id);
    }, 2000 );
}

function showMessage(id) {
    $(id).animate({opacity: 1}, 500)
         .css('display', 'block');
}

function hideMessage(id) {
    $(id).animate({opacity: 0}, 500);

    setTimeout(function(id) {
        $(id).css('display', 'none');
    }, 500);
}
