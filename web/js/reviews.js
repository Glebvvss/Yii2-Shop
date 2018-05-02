//hide all textarea tags of reply
$('.review-on-review').hide();




//show selected element for writing subreview
$('.reply').click(function() {
    var fullIdForShowTextArea = $(this).attr('id');
    var numberOfIdForShowTextArea = fullIdForShowTextArea.split('-');
    //alert(numberOfIdForShowTextArea[1]);
    $('#textarea-' + numberOfIdForShowTextArea[1]).show();
});





/*
 //hide element if click was realize out of open textarea reply
 $(document).mouseup(function (e) {
 var container = $('.review-on-review');
 if (container.has(e.target).length === 0){
 container.hide();
 }
 });
 */