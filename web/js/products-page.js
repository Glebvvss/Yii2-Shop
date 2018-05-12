function updatePageProductsWithAjax() {
    //update page after changed parameters of select tags sort type and number products per page
    $('.ajax-update').change(function () {
        ajaxQueryOfUpdateSortProducts();
    });
    //update page after click on arrow of control directions
    $('#sort-direction').click( function() {
        changeDirectionOfSortProducts();
        ajaxQueryOfUpdateSortProducts();
    });
}updatePageProductsWithAjax();

function ajaxQueryOfUpdateSortProducts() {
    var sortDirection = $('#sort-direction').attr('data-id');
    var productsPerPage = $('#products-per-page').val();
    var idCategory = $('#update').attr('data-id');
    var sortType = $('#sort-type').val();

    $.ajax({
        url: 'http://basic/shop/products',
        type: 'GET',
        data: {
            products_per_page: productsPerPage,
            sort_direction: sortDirection,
            id_category: idCategory,
            sort_type: sortType
        },
        success: function (page) {
            $('#update').html(page);
            updateAjaxVarsOnPage(productsPerPage, sortType);
            updatePageProductsWithAjax();
            setProductsViewStyle();
        }
    });
}

function updateAjaxVarsOnPage(productsPerPage, sortType) {
    $('#products-per-page').val(productsPerPage);
    $('#sort-type').val(sortType);
}

function changeDirectionOfSortProducts() {
    var sortDirection = $('#sort-direction').attr('data-id');
    if ( sortDirection === 'DESC' ) {
        $('#sort-direction').attr('data-id', 'ASC');
    }
    else if ( sortDirection === 'ASC' ) {
        $('#sort-direction').attr('data-id', 'DESC');
    }
}

//select view style of products
function setProductsViewStyle() {
    (function () {
        var container = document.getElementById('cbp-vm'),
            optionSwitch = Array.prototype.slice.call(container.querySelectorAll('div.cbp-vm-options > a'));

        function init() {
            optionSwitch.forEach(function (el, i) {
                el.addEventListener('click', function (ev) {
                    ev.preventDefault();
                    _switch(this);
                }, false);
            });
        }

        function _switch(opt) {
            // remove other view classes and any any selected option
            optionSwitch.forEach(function (el) {
                classie.remove(container, el.getAttribute('data-view'));
                classie.remove(el, 'cbp-vm-selected');
            });
            // add the view class for this option
            classie.add(container, opt.getAttribute('data-view'));
            // this option stays selected
            classie.add(opt, 'cbp-vm-selected');
        }
        init();
    })();
}setProductsViewStyle();
