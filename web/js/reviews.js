function hideAndShowSubReviewsCRUD() {
    //hide form sub-reviews by default
    $('.review-on-review').hide();

    //show selected element for writing subreview
    $('.reply').click(function () {
        var fullIdForShowTextArea = $(this).attr('id');
        var numberOfIdForShowTextArea = fullIdForShowTextArea.split('-');
        $('#crud-' + numberOfIdForShowTextArea[1]).show();
    });


    //hide element if click was realize out of open textarea reply
    $(document).mouseup(function (e) {
        var container = $('.review-on-review');
        if (container.has(e.target).length === 0) {
            container.hide();
        }
    });
}hideAndShowSubReviewsCRUD();

function numberOfIdParent(idParent) {
    var arrayIdParent = idParent.split('-');
    return arrayIdParent[3];
}

function numberOfId(id) {
    var arrayId = id.split('-');
    return arrayId[1];
}

function addReview() {
    $('.add-review').click(function () {
        var idOfClickerClass = $(this).attr('id');
        var idParentReview = numberOfIdParent(idOfClickerClass);
        var idProduct = $('#ajax-update').attr('data-id');
        var review = $('#textarea-' + idParentReview).val();
        $.ajax({
            url: '/shop/add-review-ajax',
            type: 'POST',
            data: {
                id_parent_review: idParentReview,
                id_product: idProduct,
                review: review
            },
            success: function (page) {
                $('#ajax-update').html(page);
                hideAndShowSubReviewsCRUD();
                deleteReview();
                addReview();
            }
        });
    });
}addReview();

function deleteReview() {
    $('.delete-review').click(function () {
        var idOfClickerClass = $(this).attr('id');
        var idReview = numberOfId(idOfClickerClass);
        var idProduct = $('#ajax-update').attr('data-id');
        $.ajax({
            url: '/shop/delete-review-ajax',
            type: 'POST',
            data: {
                id_product: idProduct,
                id_review: idReview
            },
            success: function (page) {
                $('#ajax-update').html(page);
                hideAndShowSubReviewsCRUD();
                deleteReview();
                addReview();
            }
        });
    });
}deleteReview();